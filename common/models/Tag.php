<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string $name
 * @property int position
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id', 'position'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'position' => 'position',
        ];
    }

    public function stringTurnArray($tags){
        return explode(',',$tags);
    }

    public function arrayTurnString($tags){
        return implode(',',$tags);
    }

    public static function addTages(array $tags){
        if(count($tags)> 0 ){
            return false;
        }
        foreach ($tags as $key => $item){
            $tag = self::findOne(['name'=>trim($item)]);
            if($tag){
                $tag->position = $tag->position+1;
                $tag->save(false);
            }
            else {
                $tag = new Tag();
                $tag->name = $item;
                $tag->position = 1;
                $tag->save(false);
            }
        }
    }

    public static function deleteTarges(array $tags){
        if(count($tags)> 0 ){
            return false;
        }
        foreach ($tags as $key => $item){
            $tag = self::findOne(['name'=>trim($item)]);
            if($tag){
                $tag->position = $tag->position - 1;
                if( $tag->position <=0){
                    $tag->delete();
                    continue;
                }
                else{
                    $tag->save();
                }
            }
        }
    }

    public static function updateFrequency($oldTargs,$newTargs){
        if(!empty($oldTargs) || !empty($newTargs)){
            $oldTargsArray = self::stringTurnArray($oldTargs);
            $newTargsArray = self::stringTurnArray($newTargs);
            self::addTages(array_values(array_diff($newTargsArray,$oldTargsArray)));
            self::deleteTarges(array_values(array_diff($oldTargsArray,$newTargsArray)));
        }
    }
}
