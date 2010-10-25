<?php

class JsonLogBuilder implements LogBuilder {

    private $log; // instance of Log
    private $arrJson = array();

    public function JsonLogBuilder(Log $log) {
        $this->log = $log;
    }

    public function buildDate() {
        $this->arrJson[] = array('date' => $this->log->getDate());
    }

    public function buildConsumption() {
        $this->arrJson[] = array('consumption' => $this->log->getConsumption());
    }

    // returns a concrete product String
    public function getResult() {
        return json_encode($this->arrJson);
    }

}

// implementation
//$log = new Log();
//$log->setDate('10/20/2010');
//
//$con = new Consumption(new BasicFood('cheese1'), 1);
//$log->setConsumption($con);
//$con = new Consumption(new BasicFood('cheese2'), 1);
//$log->setConsumption($con);
//$con = new Consumption(new BasicFood('cheese3'), 1);
//$log->setConsumption($con);
//$con = new Consumption(new BasicFood('cheese3'), 1);
//$log->setConsumption($con);
//
//$jsonLogBuilder = new JsonLogBuilder($log);
//$jsonLogBuilder->buildDate();
//$jsonLogBuilder->buildConsumption();
//$jsonString = $jsonLogBuilder->getResult();
//echo "hjereis the log:" . $jsonString;
?>
