<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | Filname: phpZipLocator.php                                           |
// +----------------------------------------------------------------------+
// | Copyright (c) http://www.sanisoft.com                                |
// +----------------------------------------------------------------------+
// | License (c) This software is licensed under LGPL                     |
// +----------------------------------------------------------------------+
// | Description: A simple class for finding distances between two zip    |
// | codes, The distance calculation is based on Zipdy package found      |
// | at http://www.cryptnet.net/fsp/zipdy/ written by V. Alex Brennen     |
// | <vab@cryptnet.net>                                                   |
// | You can also do radius calculations to find all the zipcodes within  |
// | the radius of x miles                                                |
// +----------------------------------------------------------------------+
// | Authors: Dr Tarique Sani <tarique@sanisoft.com>                      |
// |          Girish Nair <girish@sanisoft.com>                           |
// +----------------------------------------------------------------------+
//
// $Id$

class zipLocator
{

    /**
     * Short description.
     * This method returns the distance in Miles between two zip codes
     * Detail description
     * This method returns the distance in Miles between two zip codes, if either of the zip code is not found and error is retruned
     * @param      zipOne - The first zip code
     * @param      zipTwo - The second zip code
     * @global     db - the database object
     * @since      1.0
     * @access     public
     * @return     string
     * @update
    */
    function distance($zipOne,$zipTwo)
    {
       global $db;
       $query = "SELECT * FROM zipData WHERE zipcode = $zipOne";

       $result = $db->query($query);
       if(!$result->rowCount()) {
           return "First Zip Code not found";
       }else{
           $data = $result->fetch(PDO::FETCH_ASSOC);
           $lat1 = $data['lat'];
           $lon1 = $data['lon'];
       }

       $query = "SELECT * FROM zipData WHERE zipcode = $zipTwo";

       $result = $db->query($query);
       if(!$result->rowCount()) {
           return "Second Zip Code not found";
       }else{
           $data = $result->fetch(PDO::FETCH_ASSOC);
           $lat2 = $data['lat'];
           $lon2 = $data['lon'];
       }

       /* Convert all the degrees to radians */
       $lat1 = $this->deg_to_rad($lat1);
       $lon1 = $this->deg_to_rad($lon1);
       $lat2 = $this->deg_to_rad($lat2);
       $lon2 = $this->deg_to_rad($lon2);

       /* Find the deltas */
       $delta_lat = $lat2 - $lat1;
       $delta_lon = $lon2 - $lon1;

       /* Find the Great Circle distance */
       $temp = pow(sin($delta_lat/2.0),2) + cos($lat1) * cos($lat2) * pow(sin($delta_lon/2.0),2);

       $EARTH_RADIUS = 3956;
       $distance = $EARTH_RADIUS * 2 * atan2(sqrt($temp),sqrt(1-$temp));

       return $distance;

    } // end func

    /**
     * Short description.
     * Converts degrees to radians
     * @param      deg - degrees
     * @global     none
     * @since      1.0
     * @access     private
     * @return     void
     * @update
    */
    function deg_to_rad($deg)
    {
        $radians = 0.0;
        $radians = $deg * M_PI/180.0;
        return($radians);
    }


    /**
     * Short description.
     * This method retruns an array of zipcodes found with the radius supplied
     * Detail description
     * This method returns an array of zipcodes found with the radius supplied in miles, if the zip code is invalid an error string is returned
     * @param      zip - The zip code
     * @param      radius - The radius in miles
     * @global     db - instance of database object
     * @since      1.0
     * @access     public
     * @return     array/string
     * @update     date time
    */
    function inradius($zip,$radius)
    {
        global $db;
        $query="SELECT * FROM zipData WHERE zipcode='$zip'";
        $result = $db->query($query);

        if($result->rowCount()<>0) {
            $data = $result->fetch(PDO::FETCH_ASSOC);
            $lat=$data['lat'];
            $lon=$data['lon'];
            $query="SELECT zipcode FROM zipData WHERE (POW((69.1*(lon-\"$lon\")*cos($lat/57.3)),\"2\")+POW((69.1*(lat-\"$lat\")),\"2\"))<($radius*$radius) ";
            $result = $db->query($query);
            if($result->rowCount()<>0) {
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                foreach($data as $data){
                  $zipArray[] = $data['zipcode'];
                }
            }
        }else{
            return "Zip Code not found";
        }
     return $zipArray;
    } // end func

} // end class
?>