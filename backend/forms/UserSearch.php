<?php

namespace backend\forms;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use post\entities\User\User;

/**
 * UserSearch represents the model behind the search form of `post\entities\User\User`.
 */
class UserSearch extends Model
{
    public $id;
    public $created_at;
    public $username;
    public $email;
    public $status;

    public function rules()
    {
        return [
            [['id', 'status', 'created_at'], 'integer'],
            [['username', 'email'], 'safe'],
        ];
    }

    /**
    Creates data provider instance with search query applied
     *
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }


        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,

        ]);

        $query
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email]);;

        return $dataProvider;
    }
}
