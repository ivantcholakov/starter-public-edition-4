<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->model('countries');
    }

    public function guess($known_data) {

        $vars = array(
            'latitude',
            'longitude',
            'zoom',
            'country_id',
        );

        foreach ($vars as $var) {
            ${$var} = null;
        }

        $known_data = array_only($known_data, $vars);
        extract($known_data);

        $found = is_numeric($latitude) && is_numeric($longitude);

        $latitude = 0.0;
        $longitude = 0.0;

        if (!is_numeric($zoom)) {
            $zoom = 1.0;
        }

        if (!$found) {

            //$this->load->model('countries');    // TODO: This does not work.

            $id = (int) $country_id;

            if (!empty($country_id)) {

                $row = $this->countries->select('latitude, longitude')->get($id);

                if (!empty($row) && is_numeric($row['latitude']) && is_numeric($row['longitude'])) {

                    $latitude = $row['latitude'];
                    $longitude = $row['longitude'];
                    $zoom = 6.0;
                    $found = true;
                }
            }
        }

        $result = array(
            'latitude' => (double) $latitude,
            'longitude' => (double) $longitude,
            'zoom' => (double) $zoom,
            'found' => $found,
        );

        return $result;
    }

}
