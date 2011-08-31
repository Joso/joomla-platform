<?php
class JMatrix
{
    private $base = '';

    private $logBase = '';

    private $checkstyle = false;
    private $junit = false;
    private $loc = false;

    public function __construct($base)
    {
        if( ! is_dir($base))
        return;

        $subDir = '/build/logs';

        if( ! is_dir($base.'/'.$subDir))
        return;


        $this->base = $base;

        $this->logBase = $this->base.'/'.$subDir;

        $this->createMatrix();
    }//function

    public function __get($what)
    {
        if( ! isset($this->$what))
        {

            echo __METHOD__.' -- Unknown: '.$what;

            return;
        }

        return $this->$what;
    }//function

    public function getCheckStyleCounts()
    {
        $counts = new stdClass;
        $counts->files = 0;
        $counts->errors = 0;
        $counts->warnings = 0;

        if( ! $this->checkstyle)
        return $counts;

        foreach ($this->checkstyle->file as $file)
        {
            $counts->files ++;

            foreach ($file->error as $error)
            {
                switch ($error->attributes()->severity)
                {
                    case 'error':
                        $counts->errors ++;
                        break;

                    case 'warning':
                        $counts->warnings ++;
                        break;

                    default:
                        break;
                }//switch
            }//foreach
        }//foreach

        return $counts;
    }//function

    private function createMatrix()
    {
        $this->readCheckstyle();
        $this->readJUnit();
        $this->readLoc();

    }//function

    private function readCheckstyle()
    {
        $fileName = $this->logBase.'/checkstyle.xml';

        if( ! file_exists($fileName))
        return;

        $xml = simplexml_load_file($fileName);

        $this->checkstyle = $xml;
    }
    private function readJUnit()
    {
        $fileName = $this->logBase.'/junit.xml';

        if( ! file_exists($fileName))
        return;

        $xml = simplexml_load_file($fileName);

        $this->junit = $xml;
    }

    private function readLoc()
    {
        $fileName = $this->logBase.'/phploc.csv';

        if( ! file_exists($fileName))
        return;

        $row = 0;
        $handle = fopen ($fileName,"r");

        $contents = array();

        while(false !== ($data = fgetcsv($handle, 1000, ',')))
        {
            $contents[] = $data;
        }

        fclose ($handle);

        $result = array_combine($contents[0], $contents[1]);

        $this->loc = $result;
    }//function
}//class
