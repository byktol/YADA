<?php
class JsonLogBuilder implements LogBuilder {

    private $date;
    private $consumption;
    private $jsonLog;

    public function JsonLogBuilder($date='', $consumption=NULL) {
        $this->date = $date;
        $this->consumption = $consumption;
        $this->jsonLog = new JsonLog();
    }

    public function buildDate() {
        $this->jsonLog->setDate($this->date);
    }

    public function buildConsumption() {
        foreach ($this->consumption as $consumption) {
            $this->jsonLog->setConsumption($consumption);
        }
    }

    // returns a concrete product JsonLog
    public function getResult() {
        return $this->jsonLog;
    }

}

// implementation
//$arrConsumption = array(
//    new Consumption(new BasicFood('cheese'), 1),
//    new Consumption(new BasicFood('cheese1'), 1),
//    new Consumption(new BasicFood('cheese2'), 1),
//);
//
//$jsonLogBuilder = new JsonLogBuilder('', $arrConsumption);
//$jsonLogBuilder->buildDate();
//$jsonLogBuilder->buildConsumption();
//$jsonString = $jsonLogBuilder->getResult();
//echo "hjereis the log:".$jsonString->toString();
?>
