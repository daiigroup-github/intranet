<?php

class FitfastGradeFCommand extends CConsoleCommand
{

	public function writeToFile($filename, $string, $mode = 'w+')
	{
		$handle = fopen($filename, $mode);
		fwrite($handle, $string);
		fclose($handle);
	}

	public function run()
	{
        /**
         * find all grade 0 : last month
         */
        FitfastTarget::model()->gradeForDidNotUpLoad();
	}

}
