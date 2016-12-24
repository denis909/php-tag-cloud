<?php

namespace denis909\yii\helpers;

class ActiveRecordHelper
{

	public static function get($class, $col, $uid, $create = FALSE, $attributes = array())
	{
		$model = $class::find()->where([$col => $uid])->one();
		
		if ($model == FALSE)
		{
			if ($create == FALSE)
			{
				return FALSE;
			}
		
			Yii::$app->db->createCommand('LOCK TABLES '.$class::tableName().' AS t WRITE');

			$count = $class::find()->where([$col => $uid])->count();
			
			if ($count == 0)
			{				
				$attributes[$attributeName] = $uid;
			
				Yii::$app->db->createCommand()->insert($class::tableName(), $attributes)->execute();
			}
			
			Yii::$app->db->createCommand('UNLOCK TABLES');
			
			return $class::get($uid, $create, $attributeName);
		}
		
		return $model;
	}

}