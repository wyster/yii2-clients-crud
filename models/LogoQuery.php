<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Logo]].
 *
 * @see Logo
 */
class LogoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Logo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Logo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
