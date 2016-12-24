<?php

namespace denis909\yii\helpers;

class TagCloudHelper
{

	public static function tagSize($count, $minCount, $maxCount, $minSize = 1, $maxSize = 10)
	{
		if ($count == 0)
		{
			return 0;
		}
		
		$diff = $maxCount - $minCount;
		
		if ($diff == 0) 
		{	
			$diff++;
		}
		
		$diffSize = $maxSize - $minSize;
		
		return round((($count - $minCount) / $diff) * $diffSize + $minSize);	
	}
	
	public static function logTagSize($count, $minCount, $maxCount, $minSize = 1, $maxSize = 10)
	{
        $minCount = log($minCount + 1);
        
        $maxCount = log($maxCount + 1);
        
		if ($count == 0)
		{
			return 0;
		}
		
		$diffSize = $maxSize - $minSize;
		
		$diffCount = $maxCount - $minCount;
		
		if ($diffCount == 0)
		{
			return round($minSize + (($maxSize - $minSize) / 2));
		}
		
		return round($minSize + (log(1 + $count) - $minCount) * ($diffSize / $diffCount));
	}

}