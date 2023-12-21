<?php
// Perusahaan_model.php

namespace App\Models;

use CodeIgniter\Model;

class Admin_model extends Model
{
    public function addPerusahaan($data)
    {
        // You can send the data to the external API here
        $apiUrl = "http://dev.quinsis.co.id/flask/api/add_perusahaan";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
        )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false; // Failed to send data to the API
        } else {
            $responseData = json_decode($response, true);
            return $responseData; // Return the API response
        }
    }
    public function addVendor($data)
    {
        // You can send the data to the external API here
        $apiUrl = "http://dev.quinsis.co.id/flask/api/add_vendor";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
        )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false; // Failed to send data to the API
        } else {
            $responseData = json_decode($response, true);
            return $responseData; // Return the API response
        }
    }
    public function addPegawai($data)
    {
        // You can send the data to the external API here
        $apiUrl = "http://dev.quinsis.co.id/flask/api/tambahPegawai";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
        )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false; // Failed to send data to the API
        } else {
            $responseData = json_decode($response, true);
            return $responseData; // Return the API response
        }
    }
    public function addProject($data)
    {
        // You can send the data to the external API here
        $apiUrl = "http://dev.quinsis.co.id/flask/api/tambahproject";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
        )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false; // Failed to send data to the API
        } else {
            $responseData = json_decode($response, true);
            return $responseData; // Return the API response
        }
    }
    public function addTahapan($data, $id)
    {
        // You can send the data to the external API here
        $apiUrl = "http://dev.quinsis.co.id/flask/api/tambahTahapan/{$id}";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
        )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false; // Failed to send data to the API
        } else {
            $responseData = json_decode($response, true);
            return $responseData; // Return the API response
        }
    }
    public function addDtahapan($id_tahapan, $data)
    {
        // You can send the data to the external API here
        $apiUrl = "http://dev.quinsis.co.id/flask/api/tambahdetail/{$id_tahapan}";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
        )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false; // Failed to send data to the API
        } else {
            $responseData = json_decode($response, true);
            return $responseData; // Return the API response
        }
    }
    public function addAnggota($id_project, $data)
    {
        // You can send the data to the external API here
        $apiUrl = "http://dev.quinsis.co.id/flask/api/addStruktur/{$id_project}";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
        )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false; // Failed to send data to the API
        } else {
            $responseData = json_decode($response, true);
            return $responseData; // Return the API response
        }
    }

}
