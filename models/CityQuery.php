<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[City]].
 *
 * @see City
 */
class CityQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return City[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return City|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param string $q
     * @return City[]
     */
    public function search(string $q): array
    {
        return $this->where(['like', 'name', $q])
                ->limit(20)
                ->all();
    }

    /**
     * @param int $id
     * @return null|City
     */
    public function getById(int $id): ?City
    {
        return $this->where(['id' => $id])->one();
    }
}
