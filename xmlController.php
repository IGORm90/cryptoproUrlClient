<?php

class xmlController {

    private $xmlfolder = 'files/';

    public function prepareXML($inputXml){

        try {

            $startXml = strpos($inputXml, '<s>');
            $endtXml = strrpos($inputXml, '</s>');
            $outXml = new SimpleXMLElement(substr($inputXml, $startXml, $endtXml));

            return $outXml->asXML();

        } catch (Exception $e) {
            return false;
        }
        
    }

    public function saveXmlFile($xmlString){
        try {
            file_put_contents($this->xmlfolder.'answ.xml', $xmlString);
        } catch (Exception $e) {
            return false;
        }
    }

    public function getError($xmlString){
        $xml = new SimpleXMLElement($xmlString);
        foreach($xml as $x){
            if(isset($x->attributes()['n']) && $x->attributes()['n'] == 'ValidationErrors'){
                if(isset($x->s->a)){
                    return $x->s->a->__toString();
                }
            }
        }
        return false;
    }

}