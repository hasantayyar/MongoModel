<?php
/**
 * MongoFactory is a simple Factory class for instantiating MongoEntity objects.
 * Source: github.com/gatesvp/MongoModel
 * @author: Gaetan Voyer-Perrault (github.com/gatesvp/)
 * @date: 2010-10-25
 */

class MongoFactory {

  public static function LoadObjectById($type, $id){

    if(class_exists($type)){

      $obj = new $type;
      $obj->load_single($id);
      return $obj;

    }
    else{

      return null;

    }

  }

  public static function LoadObjectsByQuery($type, $query = array()){

    if(class_exists($type)){

      $obj = new $type;
      $result_set = array();

      try{

        $collection = $obj->loadCollection();
        $results = $collection->find($query);

        while($results->hasNext()){
          $x = $results->getNext();
          $result_set[] = new $type($x);
        }

        return $result_set;
      }
      catch(Exception $e){
        /* TODO: Handle exception */
        return null;
      }
    }
    else {

      return null;

    }

  }

}
?>
