<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ParserController extends Controller
{
    /**
     * @var bool
     */
    public $force = false;

    public function options($actionID): array
    {
        return ['force'];
    }

    public function optionAliases(): array
    {
        return ['f' => 'force'];
    }

    /**
     * This command echoes what you have entered as the message.
     * @return int Exit code
     */
    public function actionRegionsAndCities(): int
    {
        // Затирает регион и города в базе в случае их существования
        if ($this->force) {
            try {
                \Yii::$app->db->beginTransaction();
                \Yii::$app->db->createCommand()->setSql('SET FOREIGN_KEY_CHECKS = 0;')->execute();
                \Yii::$app->db->createCommand()->truncateTable('{{%city%}}')->execute();
                \Yii::$app->db->createCommand()->truncateTable('{{%region%}}')->execute();
                \Yii::$app->db->createCommand()->setSql('SET FOREIGN_KEY_CHECKS = 1;')->execute();
                \Yii::$app->db->getTransaction()->commit();
            } catch (\Exception $e) {
                \Yii::$app->db->getTransaction()->rollBack();
                throw $e;
            }
        }

        if (\app\models\Region::find()->count()) {
            throw new \InvalidArgumentException('Regions not empty');
        }
        if (\app\models\City::find()->count()) {
            throw new \InvalidArgumentException('Cities not empty');
        }
        $result = [];
        foreach ($this->getData() as $item) {
            if (!array_key_exists($item['region'], $result)) {
                $result[$item['region']] = [];
            }

            $result[$item['region']][] = $item['city'];
        }
        foreach ($result as $region => $cities) {
            $regionModel = new \app\models\Region();
            $regionModel->name = $region;
            if ($regionModel->insert()) {
                foreach ($cities as $city) {
                    $cityModel = new \app\models\City();
                    $cityModel->region_id = $regionModel->id;
                    $cityModel->name = $city;
                    $cityModel->insert();
                }
            }
        }

        return ExitCode::OK;
    }

    private function getData(): array
    {
        return json_decode(file_get_contents('./data/regions_and_cities.json'), true);
    }
}
