<?php

class ZHtml extends CHtml
{

	public static function stockDetailDropDownList($model, $attribute, $htmlOptions = array(
	))
	{
		return CHtml::activeDropDownList($model, $attribute, self::stockDetailItem(), $htmlOptions);
	}

	public static function stockDetailItem()
	{
		$model = new StockDetail();
		$model = $model->findAll();
		$values = array(
			0=>"Select..");
		foreach($model as $value)
		{
			$values[$value->stockDetailId] = $value->stockDetailName;
		}
		return $values;
	}

	public static function enumItem($model, $attribute)
	{
		$attr = $attribute;
		self::resolveName($model, $attr);
		preg_match('/\((.*)\)/', $model->tableSchema->columns[$attr]->dbType, $matches);
		foreach(explode(',', $matches[1]) as $value)
		{
			$value = str_replace("'", null, $value);
			$values[$value] = Yii::t('enumItem', $value);
		}
		return $values;
	}

}
