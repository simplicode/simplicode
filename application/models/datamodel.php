<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'vendor\autoload.php';

use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;
use WindowsAzure\Table\Models\Entity;
use WindowsAzure\Table\Models\EdmType;
use WindowsAzure\Table\Models\Filters\QueryStringFilter;

class Datamodel extends CI_Model {
    
    function __construct() {
        parent::__construct();
        defined('AZURE_CONNECTION_STRING') or define ('AZURE_CONNECTION_STRING', "DefaultEndpointsProtocol=https;AccountName=simplifik;AccountKey=ZJ2waKQ2eSrNysahoAgkzHyXkOtNcJVZLSwsjLhbbSYcID7yK+Yl1Pc7AhNuG07rQA6mc2UkT78JkYb/yE1RTg==");
    }

    function upload_command($grupo, $dispositivo, $mensaje) {

        $tableRestProxy = ServicesBuilder::getInstance()->createTableService(AZURE_CONNECTION_STRING);

        $entity = new Entity();
        $entity->setPartitionKey(strval($grupo));
        $entity->setRowKey(strval($dispositivo));
        $entity->addProperty("mensaje", EdmType::STRING, strval($mensaje));
            
        try {
            $tableRestProxy->insertEntity("messages", $entity);    
        } catch(ServiceException $e) {

        }
    }

    function download_command($grupo, $dispositivo) {
        $tableRestProxy = ServicesBuilder::getInstance()->createTableService(AZURE_CONNECTION_STRING);

        try {
            $result = $tableRestProxy->getEntity("messages", $grupo, $dispositivo);
        }
        catch(ServiceException $e){
            return array();
        }
        $entity = $result->getEntity();
        $mensaje = $entity->getPropertyValue("mensaje");

        $tableRestProxy->deleteEntity("messages", $grupo, $dispositivo);

        return array(
            'id' => 1,
            'mensaje' => $mensaje
        );
    }

    function download_data() {

        $tableRestProxy = ServicesBuilder::getInstance()->createTableService(AZURE_CONNECTION_STRING);

        $options = new QueryEntitiesOptions();
        $filter = "PartitionKey ne 'hola'";
        $options->setFilter($filter);
        $options->setTop(500);

        try {
            $result = $tableRestProxy->queryEntities("data", $options);
        } catch(ServiceException $e) {
            $code = $e->getCode();
            $error_message = $e->getMessage();
            return "notallowed";
        }

        $entities = $result->getEntities();

        return $entities;
        
    }

    function upload_data($data) {

        $tableRestProxy = ServicesBuilder::getInstance()->createTableService(AZURE_CONNECTION_STRING);

        foreach ($data as $line) {

            $numero = array_values($line);


            $entity = new Entity();
            $entity->setPartitionKey(strval($numero[0]));
            $entity->setRowKey(strval($numero[1]));
            $entity->addProperty("timestamp", EdmType::STRING, strval($numero[2]));
            $valor = 0;
            foreach ($line as $key => $value) {
                if ($valor > 2) {
                    $entity->addProperty(strval($key), EdmType::STRING, strval($value));
                }
                $valor += 1;
            }

            try {
                $tableRestProxy->insertOrMergeEntity("devices", $entity);    
            } catch(ServiceException $e) {

            }

            $entity = new Entity();
            $entity->setPartitionKey(strval($numero[0]));
            $entity->setRowKey( preg_replace("/[^0-9]/", "", strval(number_format(2147483648000 - $numero[2],2)) ));
            $entity->addProperty("device", EdmType::STRING, strval($numero[1]));
            $entity->addProperty("timestamp", EdmType::STRING, strval($numero[2]));

            $valor = 0;
            foreach ($line as $key => $value) {
                if ($valor > 2) {
                    $entity->addProperty(strval($key), EdmType::STRING, strval($value));
                }
                $valor += 1;
            }

            try {
                $tableRestProxy->insertEntity("data", $entity);    
            } catch(ServiceException $e) {

            }

            usleep(10);

        }
    }

    function get_devices($id) {
        $tableRestProxy = ServicesBuilder::getInstance()->createTableService(AZURE_CONNECTION_STRING);

        $filter = "device eq '".$id."'";

        try {
            $result = $tableRestProxy->queryEntities("data", $filter);
            $entities = $result->getEntities();
        } catch(ServiceException $e) {
            $code = $e->getCode();
            $error_message = $e->getMessage();
            return array();
        }
        
        $devicearray = array();

        foreach($entities as $entity) {
            
            $devicearray[] = array(
                'grupo' => $entity->getRowKey(),
                'id' => $entity->getPropertyValue("device"),
                'timestamp' => $entity->getPropertyValue("timestamp"),
                'temperatura' => $entity->getPropertyValue("temperatura"),
                'humedad' => $entity->getPropertyValue("humedad")
            );
        }

        //$devicearray = array_reverse($devicearray);

        return $devicearray;

    }


    function get_current_devices() {
        $tableRestProxy = ServicesBuilder::getInstance()->createTableService(AZURE_CONNECTION_STRING);

        $filter = "PartitionKey ne 'hola'";

        try {
            $result = $tableRestProxy->queryEntities("devices", $filter);
            $entities = $result->getEntities();
        } catch(ServiceException $e) {
            $code = $e->getCode();
            $error_message = $e->getMessage();
            return array();
        }
        
        $devicearray = array();

        foreach($entities as $entity) {
            $devicearray[] = array(
                'grupo' => $entity->getPartitionKey(),
                'id' => $entity->getRowKey(),
                'lat' => $entity->getPropertyValue("lat"),
                'lon' => $entity->getPropertyValue("lon")
            );
        }

        return $devicearray;

    }

}