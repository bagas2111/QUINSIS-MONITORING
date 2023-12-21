<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends BaseController
{
    public $helpers = ['url'];

    public function index()
    {
        if (!session()->has('id_pegawai')) {
            return redirect()->to('/Login');
        }
        $id_pegawai = session()->get('id_pegawai');
        $nama = session()->get('nama');
        $data['id_pegawai'] = $id_pegawai;


        $apiUrl = "http://192.168.18.158:5000/projects?id_pegawai={$id_pegawai}";
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $apiUrl,
                CURLOPT_RETURNTRANSFER => true,
            )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "Error: " . $err;
        } else {
            $responseData = json_decode($response, true);
            $data['home'] = $responseData;
            $data['nama'] = $nama;
            return view('project/home', $data);
        } // Removed leading slash from view path
    }

    public function projects()
    {

        if (!session()->has('id_pegawai')) {
            return redirect()->to('/Login');
        }

        $id_pegawai = session()->get('id_pegawai');
        $data['id_pegawai'] = $id_pegawai;

        // Fetch data from the API
        $apiUrl = "http://192.168.18.158:5000/projects?id_pegawai={$id_pegawai}";
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $apiUrl,
                CURLOPT_RETURNTRANSFER => true,
            )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "Error: " . $err;
        } else {
            $responseData = json_decode($response, true);
            $data['projects'] = $responseData;
            return view('project/projects', $data);
        } // Removed leading slash from view path
    }

    public function layout()
    {
        return view('layout/template');

    }

    public function test()
    {
        return view('/project/test');
    }

    public function template()
    {
        return view('/layout/template');
    }

    public function pegawai()
    {
        if (!session()->has('id_pegawai')) {
            return redirect()->to('/Login');
        }

        // Mendapatkan id_pegawai dari sesi
        $id_pegawai = session()->get('id_pegawai');

        // Menggunakan cURL untuk mengambil data dari API
        $apiUrl = "http://192.168.18.158:5000/datadash/{$id_pegawai}";
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $apiUrl,
                CURLOPT_RETURNTRANSFER => true,
            )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "Error: " . $err;
        } else {
            $responseData = json_decode($response, true);
            $data['data2'] = $responseData;

            // Render view dengan data yang diperoleh dari API
            return view('/project/data-pegawai', $data);
        }
    }


    public function tahapan($id, $nama_project)
    {
        if (!session()->has('id_pegawai')) {
            return redirect()->to('/Login');
        }

        // Fetch data proyek berdasarkan id_project dari data POST
        $apiUrl = "http://192.168.18.158:5000/tahapan?ID_project={$id}";
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $apiUrl,
                CURLOPT_RETURNTRANSFER => true,
            )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "Error: " . $err;
        } else {
            $responseData = json_decode($response, true);
            $data['tahapam'] = $responseData;
            $data['nama_project'] = $nama_project;
            $data['id'] = $id; // Menyimpan nama_project di dalam data

            // Determine the previous page URL (projects page)
            $previousPageUrl = base_url('dashboard/projects');
            $data['previousPageUrl'] = $previousPageUrl;

            // Mengirim data proyek dan previousPageUrl ke tampilan tahapan
            return view('/project/tahapan', $data);
        }
    }
    public function detail_tahapan($id_tahapan, $nama_tahapan)
    {
        if (!session()->has('id_pegawai')) {
            return redirect()->to('/Login');
        }

        // Mengambil id_pegawai dari session
        $id_pegawai = session()->get('id_pegawai');

        // Menggunakan cURL untuk mengambil data dari API
        $api_url = "http://192.168.18.158:5000/detail?ID_tahapan=" . $id_tahapan;

        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            // Handle error jika ada
            return "Error: " . curl_error($ch);
        }

        curl_close($ch);

        // Decode respons JSON dari API
        $tahapanData = json_decode($response, true);

        // Kirim data tugas ke view
        $data['nama_tahapan'] = $nama_tahapan;
        $data['tahapanData'] = $tahapanData;

        return view('/project/detail-tahapan', $data);
    }

    public function hasil($id_tahapan, $nama_tugas, $id_detail)
    {
        // if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
        //     // Jika tidak ada session id_pegawai atau jika level bukan admin
        //     echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/Login";</script>';
        //     return; // Contoh: Kembali ke dashboard jika tidak ada izin admin
        // }

        // Build the API URL
        $apiUrl = "http://192.168.18.158:5000/detail?ID_tahapan=" . $id_tahapan; // You can change the query parameter as needed

        // Fetch data from the API
        $apiData = file_get_contents($apiUrl);

        if ($apiData === false) {
            // Handle the error if fetching data fails
            echo "Error fetching data from API.";
        } else {
            // Parse the JSON response
            $data['apiData'] = json_decode($apiData, true);

            // Include the id_detail in the data array
            $data['id_detail'] = $id_detail;

            // Fetch file name from another API
            $fileApiUrl = "http://192.168.18.158:5000/hasilTugas?id_detail=" . $id_detail;
            $fileData = file_get_contents($fileApiUrl);

            $data['file_name'] = $fileData; // Assuming the API returns the file name as plain text
            $data['nama_tugas'] = $nama_tugas;

            // Pass the data to the view
            return view('project/hasil', $data);
        }
    }
    public function uploadFile()
    {
        
        // Check if the form has been submitted
        if ($this->request->getMethod() === 'post') {
            // Get the uploaded file
            $file = $this->request->getFile('file');

            // Get the id_detail from the form
            $id_detail = $this->request->getPost('id_detail');
            $newFilename = time() . '_' . $file->getName();


            // Check if the file was uploaded successfully
            if ($file->isValid() && !$file->hasMoved()) {
                // Generate a new filename based on the current timestamp and the original filename
                // Set the new filename for the uploaded file
                $file->move(ROOTPATH . 'uploads', $newFilename);

                // You can now use $newFilename to store the file information in your database or take any other actions you need.
                // For example, you can save the file details in your database associated with the specific task.

                // Prepare the data for the API request
                $postData = [
                    'hasil_tugas' => $newFilename,
                    // Include the new filename in the request
                ];

                // Send the data to the API using cURL
                $apiUrl = 'http://192.168.18.158:5000/tugasDrive?ID_detail=' . $id_detail; // Include id_detail in the URL
                $ch = curl_init($apiUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                ]);

                $response = curl_exec($ch);
                curl_close($ch);

                // Check the API response and handle it accordingly
                if ($response === false) {
                    // Handle the case where the API request failed
                    echo '<script>alert("data gagal dikirim"); window.history.go(-1);</script>';
                    return; // Redirect to an error page or return an error message.
                } else {
                    // Redirect to a success page or return a success message
                    echo '<script>alert("data terkirim"); window.history.go(-1);</script>';
                    return; // Change the URL to your success page
                }
            } else {
                // Handle the case where the file upload failed
                $error = $newFilename->getError();
                // You can display an error message or take appropriate action here.
                // Redirect to an error page or return an error message.
                return redirect()->to('/error-page'); // Change the URL to your error page
            }
        } // Redirect back to the form page
    }
    public function profile()
    {
        if (!session()->has('id_pegawai')) {
            return redirect()->to('/Login');
        }

        // Mengambil id_pegawai dari session
        $id_pegawai = session()->get('id_pegawai');

        // Menggunakan cURL untuk mengambil data dari API
        $apiUrl = "http://192.168.18.158:5000/pegawain/$id_pegawai";
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $apiUrl,
                CURLOPT_RETURNTRANSFER => true,
            )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "Error: " . $err;
        } else {
            $responseData = json_decode($response, true);
            $data['profile'] = $responseData;
            $data['id_pegawai'] = $id_pegawai;

            // Render view dengan data yang diperoleh dari API
            return view('project/profile', $data);
        }
    }
    public function updateProfile()
    {
        if (!session()->has('id_pegawai')) {
            return redirect()->to('/Login');
        }

        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (empty($password)) {
            // Password kosong, tidak perlu melakukan validasi atau mengirimkan password kosong ke API
        } else {
            if (strlen($password) < 8) {
                echo '<script>alert("Password minimal 8 karakter"); window.location.href="/dashboard/profile";</script>';
                return;
            }
            if (!preg_match('/[A-Z]/', $password)) {
                echo '<script>alert("Password harus ada huruf besar"); window.location.href="/dashboard/profile";</script>';
                return;
            }
            if (!preg_match('/[a-z]/', $password)) {
                echo '<script>alert("Password harus ada huruf kecil"); window.location.href="/dashboard/profile";</script>';
                return;
            }
        }

        // Selanjutnya, Anda dapat memanggil model untuk mengirimkan data ke API
        // Di sini, Anda dapat menggunakan fungsi atau metode yang sesuai dalam model Anda
        // untuk mengirim data ke API dengan URL yang ditentukan.
        $apiUrl = "http://192.168.18.158:5000/editProfile/$id";

        // Membuat data yang akan dikirim ke API dalam format JSON
        $data = array(
            'nama' => $nama,
            'username' => $username,
            'password' => $password,
        );

        $jsonData = json_encode($data);

        // Menggunakan cURL untuk mengirim data ke API
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); // Jika API memerlukan metode PUT
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsonData)
            )
        );

        // Eksekusi permintaan ke API
        $response = curl_exec($ch);

        // Tutup koneksi cURL
        curl_close($ch);
        header("Location: /dashboard/profile");
        exit;
    }

    public function Project_Pegawai()
    {
        return view('/project/project-pegawai');
    }
    public function logout()
    {
        // Clear id_pegawai from session
        session()->remove('id_pegawai');

        // Redirect to the login page
        return redirect()->to('Dashboard/login');
    }
}