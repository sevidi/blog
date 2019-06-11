<?php


namespace post\entities\Poll\queries;

use post\entities\Poll\Polls;

use yii\db\ActiveQuery;

class PollsQuery extends ActiveQuery
{
    /*public function active()
  {
      return $this->andWhere('[[status]]=1');
  }*/

    /**
     * @inheritdoc
     * @return Polls[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Polls|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function active($alias = null)
    {
        return $this->andWhere([
            ($alias ? $alias . '.' : '') . 'status' => Polls::STATUS_ACTIVE,
        ]);
    }

}