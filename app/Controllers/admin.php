<?php

namespace App\Controllers;

use App\Models\Admin_model;

use CodeIgniter\Controller;

class admin extends BaseController
{


    public function index()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        $nama = session()->get('nama');
        $apiUrl = "http://192.168.18.158:5000/admin/project";
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
            $data['project'] = $responseData;
            $data['nama'] = $nama;
            return view('admin/home', $data);
        }
    }

    public function pegawai()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        $apiUrl = "http://192.168.18.158:5000/pegawai";
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
            $data['pegawai'] = $responseData;
            return view('admin/pegawai', $data); // Pastikan path view-nya benar
        }
    }
    public function updateDataPegawai()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $struktur = $_POST['struktur'];
        $password = $_POST['password'];

        // Selanjutnya, Anda dapat memanggil model untuk mengirimkan data ke API
        // Di sini, Anda dapat menggunakan fungsi atau metode yang sesuai dalam model Anda
        // untuk mengirim data ke API dengan URL yang ditentukan.
        $apiUrl = "http://192.168.18.158:5000/pegawai/$id";

        // Membuat data yang akan dikirim ke API dalam format JSON
        $data = array(
            'nama' => $nama,
            'username' => $username,
            'struktur' => $struktur,
            'password' => $password
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

        // Handle respons dari API jika diperlukan
        // Misalnya, Anda dapat memeriksa $response untuk melihat apakah permintaan berhasil atau tidak.

        // Redirect ke halaman yang sesuai setelah pembaruan
        // Misalnya, kembali ke halaman edit atau halaman daftar perusahaan.

        // Contoh: kembali ke halaman daftar perusahaan
        header("Location: /admin/Pegawai");
        exit;
    }
    public function addDataPegawai()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        if ($this->request->getMethod() === 'post') {
            // Get the form data
            $nama = $this->request->getPost('nama');
            $struktur = $this->request->getPost('struktur');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            // Create an instance of the model
            $model = new Admin_model();

            // Prepare the data for sending to the model
            $data = [
                'nama' => $nama,
                'struktur' => $struktur,
                'username' => $username,
                'password' => $password,
            ];

            // Send the data to the model
            $result = $model->addPegawai($data);

            if ($result) {
                // Successfully sent data to the API
                // You can do further processing here if needed
                return redirect()->to(base_url('/admin/pegawai'))->with('success_message', 'Data berhasil dikirim');
            } else {
                // Failed to send data to the API
                // Handle the error appropriately
                return redirect()->to(base_url('/admin/error'));
            }
        } else {
            // Display the form
            return view('admin/data-perusahaan');
        }
    }
    public function hapusPegawai($id)
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        $api_url = 'http://192.168.18.158:5000/hapus_pegawai/' . $id;

        // Inisialisasi cURL
        $ch = curl_init($api_url);

        // Set opsi cURL untuk mengirim permintaan DELETE
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        // Eksekusi permintaan cURL
        $response = curl_exec($ch);

        // Tutup koneksi cURL
        curl_close($ch);

        // Periksa apakah permintaan berhasil
        if ($response === false) {
            // Penanganan kesalahan jika permintaan gagal
            echo "Gagal menghapus perusahaan.";
        } else {
            // Arahkan pengguna ke halaman admin/Perusahaan jika berhasil
            header("Location: " . base_url('admin/Pegawai'));
            exit;
        }
    }

    public function project()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        // URL API untuk data proyek
        $projectApiUrl = "http://192.168.18.158:5000/admin/project";

        // URL API untuk data perusahaan
        $perusahaanApiUrl = "http://192.168.18.158:5000/perusahaan";

        // URL API untuk data vendor
        $vendorApiUrl = "http://192.168.18.158:5000/vendor";
        $ferifApiUrl = "http://192.168.18.158:5000/tahapan/admin";

        $curl = curl_init();

        // Mengambil data proyek
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $projectApiUrl,
                CURLOPT_RETURNTRANSFER => true,
            )
        );
        $projectResponse = curl_exec($curl);
        $projectErr = curl_error($curl);

        // Mengambil data perusahaan
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $perusahaanApiUrl,
                CURLOPT_RETURNTRANSFER => true,
            )
        );
        $perusahaanResponse = curl_exec($curl);
        $perusahaanErr = curl_error($curl);

        // Mengambil data vendor
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $vendorApiUrl,
                CURLOPT_RETURNTRANSFER => true,
            )
        );
        $vendorResponse = curl_exec($curl);
        $vendorErr = curl_error($curl);
        // Mengambil data ferif
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $ferifApiUrl,
                CURLOPT_RETURNTRANSFER => true,
            )
        );
        $ferifResponse = curl_exec($curl);
        $ferifErr = curl_error($curl);

        curl_close($curl);

        if ($projectErr || $perusahaanErr || $vendorErr || $ferifErr) {
            echo "Error: " . ($projectErr ?: $perusahaanErr ?: $vendorErr ?: $ferifErr);
        } else {
            $projectData = json_decode($projectResponse, true);
            $perusahaanData = json_decode($perusahaanResponse, true);
            $vendorData = json_decode($vendorResponse, true);
            $ferifData = json_decode($ferifResponse, true);

            $data['projects'] = $projectData;
            $data['perusahaan'] = $perusahaanData;
            $data['vendor'] = $vendorData;
            $data['ferif'] = $ferifData;


            return view('admin/projects', $data);
        }
    }
    public function addDataProject()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        if ($this->request->getMethod() === 'post') {
            // Get the form data
            $nama_project = $this->request->getPost('nama_project');
            $tgl_po = $this->request->getPost('tgl_po');
            $no_po = $this->request->getPost('no_po');
            $id_perusahaan = $this->request->getPost('id_perusahaan');
            $id_vendor = $this->request->getPost('id_vendor');
            $start_project = $this->request->getPost('start_project');
            $deadline = $this->request->getPost('deadline');

            // Validate the form data here (e.g., check if required fields are not empty)
            // Handle validation errors and return an error response if needed

            // Create an instance of the model
            $model = new Admin_model();

            // Prepare the data for sending to the model
            $data = [
                'nama_project' => $nama_project,
                'tgl_po' => $tgl_po,
                'no_po' => $no_po,
                'id_perusahaan' => $id_perusahaan,
                'id_vendor' => $id_vendor,
                'start_project' => $start_project,
                'deadline' => $deadline,
            ];

            // Send the data to the model
            $result = $model->addProject($data);

            if ($result) {
                // Successfully sent data to the API
                // You can do further processing here if needed
                return redirect()->to(base_url('/admin/project'))->with('success_message', 'Data berhasil dikirim');
            } else {
                // Failed to send data to the API
                // Handle the error appropriately (e.g., display an error message)
                return redirect()->to(base_url('/admin/addperusahaan'))->with('error_message', 'Gagal mengirim data ke API');
            }
        } else {
            // Display the form
            return view('admin/data-perusahaan');
        }
    }
    public function updateDataProject()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        //     if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
        //         // Jika tidak ada session id_pegawai atau jika level bukan admin
        //         echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
        // return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

        //          // Contoh: Kembali ke dashboard jika tidak ada izin admin
        //     }
        // Ambil data dari formulir
        $id = $_POST['id'];
        $no_po = $_POST['no_po'];
        $tgl_po = $_POST['tgl_po'];
        $nama_project = $_POST['nama_project'];
        $id_perusahaan = $_POST['id_perusahaan'];
        $id_vendor = $_POST['id_vendor'];
        $start_project = $_POST['start_project'];
        $deadline = $_POST['deadline'];


        // Selanjutnya, Anda dapat memanggil model untuk mengirimkan data ke API
        // Di sini, Anda dapat menggunakan fungsi atau metode yang sesuai dalam model Anda
        // untuk mengirim data ke API dengan URL yang ditentukan.
        $apiUrl = "http://192.168.18.158:5000/editproject/$id";

        // Membuat data yang akan dikirim ke API dalam format JSON
        $data = array(
            'nama_project' => $nama_project,
            'no_po' => $no_po,
            'tgl_po' => $tgl_po,
            'id_perusahaan' => $id_perusahaan,
            'id_vendor' => $id_vendor,
            'start_project' => $start_project,
            'deadline' => $deadline,

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

        // Handle respons dari API jika diperlukan
        // Misalnya, Anda dapat memeriksa $response untuk melihat apakah permintaan berhasil atau tidak.

        // Redirect ke halaman yang sesuai setelah pembaruan
        // Misalnya, kembali ke halaman edit atau halaman daftar perusahaan.

        // Contoh: kembali ke halaman daftar perusahaan
        header("Location: /admin/project");
        exit;
    }
    public function hapusProject($id)
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }

        // Tentukan URL API
        $api_url = 'http://192.168.18.158:5000/hapusproject/' . $id;

        // Inisialisasi cURL
        $ch = curl_init($api_url);

        // Set opsi cURL untuk mengirim permintaan DELETE
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        // Eksekusi permintaan cURL
        $response = curl_exec($ch);

        // Tutup koneksi cURL
        curl_close($ch);

        // Periksa apakah permintaan berhasil
        if ($response === false) {
            // Penanganan kesalahan jika permintaan gagal
            echo "Gagal menghapus perusahaan.";
        } else {
            // Arahkan pengguna ke halaman admin/Perusahaan jika berhasil
            header("Location: " . base_url('admin/project'));
            exit;
        }
    }
    public function verifProject()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        // if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
        //     // Jika tidak ada session id_pegawai atau jika level bukan admin
        //     echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
        //     return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

        //      // Contoh: Kembali ke dashboard jika tidak ada izin admin
        // }
        // Ambil data dari formulir
        $id = $_POST['idaja1'];

        // Selanjutnya, Anda dapat memanggil model untuk mengirimkan data ke API
        // Di sini, Anda dapat menggunakan fungsi atau metode yang sesuai dalam model Anda
        // untuk mengirim data ke API dengan URL yang ditentukan.
        $apiUrl = "http://192.168.18.158:5000/project/selesai/admin/$id";

        // Membuat data yang akan dikirim ke API dalam format JSON
        $data = array(
            'status' => 'selesai'
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

        // Handle respons dari API jika diperlukan
        // Misalnya, Anda dapat memeriksa $response untuk melihat apakah permintaan berhasil atau tidak.

        // Redirect ke halaman yang sesuai setelah pembaruan
        // Misalnya, kembali ke halaman edit atau halaman daftar perusahaan.

        // Contoh: kembali ke halaman daftar perusahaan
        echo '<script>alert("data berhasil dikirim"); window.history.go(-1);</script>';
        return;
    }
    public function verifProjectGagal()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        // if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
        //     // Jika tidak ada session id_pegawai atau jika level bukan admin
        //     echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
        //     return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

        //      // Contoh: Kembali ke dashboard jika tidak ada izin admin
        // }
        // Ambil data dari formulir
        $id = $_POST['idaja2'];

        // Selanjutnya, Anda dapat memanggil model untuk mengirimkan data ke API
        // Di sini, Anda dapat menggunakan fungsi atau metode yang sesuai dalam model Anda
        // untuk mengirim data ke API dengan URL yang ditentukan.
        $apiUrl = "http://192.168.18.158:5000/project/selesai/admin/$id";

        // Membuat data yang akan dikirim ke API dalam format JSON
        $data = array(
            'status' => 'belum selesai'
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

        // Handle respons dari API jika diperlukan
        // Misalnya, Anda dapat memeriksa $response untuk melihat apakah permintaan berhasil atau tidak.

        // Redirect ke halaman yang sesuai setelah pembaruan
        // Misalnya, kembali ke halaman edit atau halaman daftar perusahaan.

        // Contoh: kembali ke halaman daftar perusahaan
        echo '<script>alert("data berhasil dikirim"); window.history.go(-1);</script>';
        return;
    }

    public function Profile()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
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
            return view('admin/profile', $data);
        }
    }
    public function updateProfile()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }

        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (empty($password)) {
            // Password kosong, tidak perlu melakukan validasi atau mengirimkan password kosong ke API
        } else {
            if (strlen($password) < 8) {
                echo '<script>alert("Password minimal 8 karakter"); window.location.href="/admin/profile";</script>';
                return;
            }
            if (!preg_match('/[A-Z]/', $password)) {
                echo '<script>alert("Password harus ada huruf besar"); window.location.href="/admin/profile";</script>';
                return;
            }
            if (!preg_match('/[a-z]/', $password)) {
                echo '<script>alert("Password harus ada huruf kecil"); window.location.href="/admin/profile";</script>';
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
        header("Location: /admin/profile");
        exit;
    }

    public function Perusahaan()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        $apiUrl = "http://192.168.18.158:5000/perusahaan";
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
            $data['perusahaan'] = $responseData;
            return view('admin/companies', $data); // Make sure the view path is correct
        }
    }
    public function updateDataPerusahaan()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        //     if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
        //         // Jika tidak ada session id_pegawai atau jika level bukan admin
        //         echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
        // return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

        //          // Contoh: Kembali ke dashboard jika tidak ada izin admin
        //     }
        // Ambil data dari formulir
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $jenis = $_POST['jenis'];
        $alamat = $_POST['alamat'];
        $phone = $_POST['phone'];

        // Selanjutnya, Anda dapat memanggil model untuk mengirimkan data ke API
        // Di sini, Anda dapat menggunakan fungsi atau metode yang sesuai dalam model Anda
        // untuk mengirim data ke API dengan URL yang ditentukan.
        $apiUrl = "http://192.168.18.158:5000/edit_perusahaan/$id";

        // Membuat data yang akan dikirim ke API dalam format JSON
        $data = array(
            'nama' => $nama,
            'jenis' => $jenis,
            'alamat' => $alamat,
            'phone' => $phone
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

        // Handle respons dari API jika diperlukan
        // Misalnya, Anda dapat memeriksa $response untuk melihat apakah permintaan berhasil atau tidak.

        // Redirect ke halaman yang sesuai setelah pembaruan
        // Misalnya, kembali ke halaman edit atau halaman daftar perusahaan.

        // Contoh: kembali ke halaman daftar perusahaan
        header("Location: /admin/Perusahaan");
        exit;
    }
    public function hapusPerusahaan($id)
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }

        // Tentukan URL API
        $api_url = 'http://192.168.18.158:5000/hapus_perusahaan/' . $id;

        // Inisialisasi cURL
        $ch = curl_init($api_url);

        // Set opsi cURL untuk mengirim permintaan DELETE
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        // Eksekusi permintaan cURL
        $response = curl_exec($ch);

        // Tutup koneksi cURL
        curl_close($ch);

        // Periksa apakah permintaan berhasil
        if ($response === false) {
            // Penanganan kesalahan jika permintaan gagal
            echo "Gagal menghapus perusahaan.";
        } else {
            // Arahkan pengguna ke halaman admin/Perusahaan jika berhasil
            header("Location: " . base_url('admin/Perusahaan'));
            exit;
        }
    }
    public function addDataPerusahaan()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        if ($this->request->getMethod() === 'post') {
            // Get the form data
            $nama = $this->request->getPost('nama');
            $jenis = $this->request->getPost('jenis');
            $alamat = $this->request->getPost('alamat');
            $phone = $this->request->getPost('phone');

            // Create an instance of the model
            $model = new Admin_model();

            // Prepare the data for sending to the model
            $data = [
                'nama' => $nama,
                'jenis' => $jenis,
                'alamat' => $alamat,
                'phone' => $phone,
            ];

            // Send the data to the model
            $result = $model->addPerusahaan($data);

            if ($result) {
                // Successfully sent data to the API
                // You can do further processing here if needed
                return redirect()->to(base_url('/admin/perusahaan'))->with('success_message', 'Data berhasil dikirim');
            } else {
                // Failed to send data to the API
                // Handle the error appropriately
                return redirect()->to(base_url('/admin/addperusahaan'));
            }
        } else {
            // Display the form
            return view('admin/data-perusahaan');
        }
    }

    public function Tahapan_admin($id, $nama_project, $no_po, $status, $deadline)
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        $apiUrl = "http://192.168.18.158:5000/tahapan?ID_project=$id";
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
            $data['tahapan'] = $responseData;
            $data['nama_project'] = $nama_project;
            $data['id'] = $id;
            $data['no_po'] = $no_po;
            $data['status'] = $status;
            $data['deadline'] = $deadline;

            // Pemanggilan kedua API
            $apiUrl2 = "http://192.168.18.158:5000/detail/admin";
            $curl2 = curl_init();

            curl_setopt_array(
                $curl2,
                array(
                    CURLOPT_URL => $apiUrl2,
                    CURLOPT_RETURNTRANSFER => true,
                )
            );

            $response2 = curl_exec($curl2);
            $err2 = curl_error($curl2);

            curl_close($curl2);

            if ($err2) {
                echo "Error: " . $err2;
            } else {
                $responseData2 = json_decode($response2, true);
                $data['detail'] = $responseData2;
                return view('admin/tahapan', $data); // Pastikan path tampilan benar
            }
        }
    }

    public function addDataTahapan()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        if ($this->request->getMethod() === 'post') {
            // Get the form data
            $id = $this->request->getPost('id');
            $nama_tahapan = $this->request->getPost('nama_tahapan');
            $start_project = $this->request->getPost('start_project');
            $deadline = $this->request->getPost('deadline');

            // Create an instance of the model
            $model = new Admin_model();

            // Prepare the data for sending to the model
            $data = [
                'nama_tahapan' => $nama_tahapan,
                'start_project' => $start_project,
                'deadline' => $deadline,
            ];

            // Send the data to the model
            $result = $model->addTahapan($data, $id);

            if ($result) {
                // Successfully sent data to the API
                // You can do further processing here if needed
                echo '<script>
                window.history.go(-1); // Kembali dua langkah ke belakang dalam riwayat peramban
              </script>';
                return;
            } else {
                // Failed to send data to the API
                // Handle the error appropriately
                echo '<script>
                window.history.go(-2); // Kembali dua langkah ke belakang dalam riwayat peramban
              </script>';
                return;
            }
        } else {
            // Display the form
            echo '<script>
                window.history.go(-0); // Kembali dua langkah ke belakang dalam riwayat peramban
              </script>';
            return;
        }
    }
    public function updateDataTahapan()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        //     if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
        //         // Jika tidak ada session id_pegawai atau jika level bukan admin
        //         echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
        // return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

        //          // Contoh: Kembali ke dashboard jika tidak ada izin admin
        //     }
        // Ambil data dari formulir
        $id = $_POST['id'];
        $nama_tahapan = $_POST['nama_tahapan'];
        $start_project = $_POST['start_project'];
        $deadline = $_POST['deadline'];

        // Selanjutnya, Anda dapat memanggil model untuk mengirimkan data ke API
        // Di sini, Anda dapat menggunakan fungsi atau metode yang sesuai dalam model Anda
        // untuk mengirim data ke API dengan URL yang ditentukan.
        $apiUrl = "http://192.168.18.158:5000/editTahapan/$id";

        // Membuat data yang akan dikirim ke API dalam format JSON
        $data = array(
            'nama_tahapan' => $nama_tahapan,
            'start_project' => $start_project,
            'deadline' => $deadline
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

        // Handle respons dari API jika diperlukan
        // Misalnya, Anda dapat memeriksa $response untuk melihat apakah permintaan berhasil atau tidak.

        // Redirect ke halaman yang sesuai setelah pembaruan
        // Misalnya, kembali ke halaman edit atau halaman daftar perusahaan.

        // Contoh: kembali ke halaman daftar perusahaan
        echo '<script>
                window.history.go(-1); // Kembali dua langkah ke belakang dalam riwayat peramban
              </script>';
        exit;
    }
    public function hapusTahapan($id)
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        $api_url = 'http://192.168.18.158:5000/hapus_tahapan/' . $id;

        // Inisialisasi cURL
        $ch = curl_init($api_url);

        // Set opsi cURL untuk mengirim permintaan DELETE
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        // Eksekusi permintaan cURL
        $response = curl_exec($ch);

        // Tutup koneksi cURL
        curl_close($ch);

        // Periksa apakah permintaan berhasil
        if ($response === false) {
            // Penanganan kesalahan jika permintaan gagal
            echo "Gagal menghapus perusahaan.";
        } else {
            // Arahkan pengguna ke halaman admin/Perusahaan jika berhasil
            echo '<script>
                window.history.go(-1); // Kembali dua langkah ke belakang dalam riwayat peramban
              </script>';
            return;
        }
    }
    public function verifTahapan()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/Login";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        // Ambil data dari formulir
        $id = $_POST['idaja'];

        // Selanjutnya, Anda dapat memanggil model untuk mengirimkan data ke API
        // Di sini, Anda dapat menggunakan fungsi atau metode yang sesuai dalam model Anda
        // untuk mengirim data ke API dengan URL yang ditentukan.
        $apiUrl = "http://192.168.18.158:5000/tahapan/selesai/admin/$id";

        // Membuat data yang akan dikirim ke API dalam format JSON
        $data = array(
            'status' => 'selesai'
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

        // Handle respons dari API jika diperlukan
        // Misalnya, Anda dapat memeriksa $response untuk melihat apakah permintaan berhasil atau tidak.

        // Redirect ke halaman yang sesuai setelah pembaruan
        // Misalnya, kembali ke halaman edit atau halaman daftar perusahaan.

        // Contoh: kembali ke halaman daftar perusahaan
        echo '<script>alert("data berhasil dikirim"); window.history.go(-1);</script>';
        return;
    }
    public function verifBatalTahapan()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/Login";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        // Ambil data dari formulir
        $id = $_POST['idaja'];

        // Selanjutnya, Anda dapat memanggil model untuk mengirimkan data ke API
        // Di sini, Anda dapat menggunakan fungsi atau metode yang sesuai dalam model Anda
        // untuk mengirim data ke API dengan URL yang ditentukan.
        $apiUrl = "http://192.168.18.158:5000/tahapan/selesai/admin/$id";

        // Membuat data yang akan dikirim ke API dalam format JSON
        $data = array(
            'status' => 'belum selesai'
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

        // Handle respons dari API jika diperlukan
        // Misalnya, Anda dapat memeriksa $response untuk melihat apakah permintaan berhasil atau tidak.

        // Redirect ke halaman yang sesuai setelah pembaruan
        // Misalnya, kembali ke halaman edit atau halaman daftar perusahaan.

        // Contoh: kembali ke halaman daftar perusahaan
        echo '<script>alert("data berhasil dikirim"); window.history.go(-1);</script>';
        return;
    }
    public function updateDetail()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        //     if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
        //         // Jika tidak ada session id_pegawai atau jika level bukan admin
        //         echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
        // return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

        //          // Contoh: Kembali ke dashboard jika tidak ada izin admin
        //     }
        // Ambil data dari formulir
        $id = $_POST['id'];
        $desc_tugas = $_POST['deskripsi'];
        $nama_tugas = $_POST['nama'];
        $end_date = $_POST['date'];


        // Selanjutnya, Anda dapat memanggil model untuk mengirimkan data ke API
        // Di sini, Anda dapat menggunakan fungsi atau metode yang sesuai dalam model Anda
        // untuk mengirim data ke API dengan URL yang ditentukan.
        $apiUrl = "http://192.168.18.158:5000/editDetail/$id";

        // Membuat data yang akan dikirim ke API dalam format JSON
        $data = array(
            'nama_tugas' => $nama_tugas,
            'desc_tugas' => $desc_tugas,
            'end_date' => $end_date,

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

        // Handle respons dari API jika diperlukan
        // Misalnya, Anda dapat memeriksa $response untuk melihat apakah permintaan berhasil atau tidak.

        // Redirect ke halaman yang sesuai setelah pembaruan
        // Misalnya, kembali ke halaman edit atau halaman daftar perusahaan.

        // Contoh: kembali ke halaman daftar perusahaan
        echo '<script>
        window.history.go(-1); // Kembali dua langkah ke belakang dalam riwayat peramban
      </script>';
        exit;
    }
    public function hapusDetail($id)
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }

        // Tentukan URL API
        $api_url = "http://192.168.18.158:5000/hapus_detail/$id";

        // Inisialisasi cURL
        $ch = curl_init($api_url);

        // Set opsi cURL untuk mengirim permintaan DELETE
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        // Eksekusi permintaan cURL
        $response = curl_exec($ch);

        // Tutup koneksi cURL
        curl_close($ch);

        // Periksa apakah permintaan berhasil
        if ($response === false) {
            // Penanganan kesalahan jika permintaan gagal
            echo "Gagal menghapus detail.";
        } else {
            // Arahkan pengguna ke halaman admin/Perusahaan jika berhasil
            echo '<script>alert("data berhasil dihapus");</script>';
            echo '<script>window.history.go(-1);</script>';
            exit;
        }
    }
    public function uploadFile()
    {
        // Check if the form has been submitted
        if ($this->request->getMethod() === 'post') {
            // Get the uploaded file
            $file = $this->request->getFile('file');

            // Get the id_detail from the form
            $id_tahapan = $this->request->getPost('id_tahapan');
            $tgl_actual = $this->request->getPost('tgl_actual');
            // Check if the file was uploaded successfully
            if ($file->isValid() && !$file->hasMoved()) {
                // Generate a new filename based on the current timestamp and the original filename
                $newFilename = time() . '_' . $file->getName();

                // Set the new filename for the uploaded file
                $file->move(ROOTPATH . 'uploads', $newFilename);

                // You can now use $newFilename to store the file information in your database or take any other actions you need.
                // For example, you can save the file details in your database associated with the specific task.

                // Prepare the data for the API request
                $postData = [
                    'hasil_tugas' => $newFilename,
                    'tgl_actual' => $tgl_actual // Include the new filename in the request
                ];

                // Send the data to the API using cURL
                $apiUrl = 'http://192.168.18.158:5000/tugasDriveTahapan?id_tahapan=' . $id_tahapan; // Include id_detail in the URL
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
                    echo '<script>
                        window.history.go(-2); // Go back two steps in the browser history
                    </script>';
                    return; // Redirect to an error page or return an error message.
                } else {
                    // Redirect to a success page or return a success message
                    echo '<script>
                        window.history.go(-1); // Go back two steps in the browser history
                    </script>';
                    return; // Change the URL to your success page
                }
            } else {
                // Handle the case where the file upload failed
                $error = $file->getError();
                // You can display an error message or take appropriate action here.
                // Redirect to an error page or return an error message.
                return redirect()->to('/error-page'); // Change the URL to your error page
            }
        } // Redirect back to the form page
    }
    public function Download($fileName)
    {
        // Path to the folder "uploads" located outside the "public" directory and at the same level as "app"
        $path = APPPATH . '../uploads/';

        // Validating the file name to prevent unauthorized access
        if (!is_file($path . $fileName)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Determine the MIME type based on the file extension
        $mimeType = mime_content_type($path . $fileName);

        // Set the appropriate headers
        header('Content-Type: ' . $mimeType);
        header('Content-Disposition: attachment; filename="' . $fileName . '"');

        // Prevent caching
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');

        // Read and send the file to the output
        readfile($path . $fileName);
    }



    public function detail($id_tahapan, $nama_tahapan, $nama_project)
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        //     if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
        //         // Jika tidak ada session id_pegawai atau jika level bukan admin
        //         echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
        // return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

        //          // Contoh: Kembali ke dashboard jika tidak ada izin admin
        //     }
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
        $data['id_tahapan'] = $id_tahapan;
        $data['nama_tahapan'] = $nama_tahapan;
        $data['nama_project'] = $nama_project;
        $data['tahapanData'] = $tahapanData;

        return view('/admin/detail-tahapan', $data);
    }
    public function addDataDtahapan()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        //     if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
        //         // Jika tidak ada session id_pegawai atau jika level bukan admin
        //         echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
        // return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

        //          // Contoh: Kembali ke dashboard jika tidak ada izin admin
        //     }
        if ($this->request->getMethod() === 'post') {
            // Get the form data
            $id_tahapan = $this->request->getPost('id_tahapan');
            $nama_tugas = $this->request->getPost('nama_tugas');
            $desc_tugas = $this->request->getPost('desc_tugas');
            $end_date = $this->request->getPost('end_date');

            // Create an instance of the model
            $model = new Admin_model();

            // Prepare the data for sending to the model
            $data = [
                'nama_tugas' => $nama_tugas,
                'desc_tugas' => $desc_tugas,
                'end_date' => $end_date,
            ];

            // Send the data to the model
            $result = $model->addDtahapan($id_tahapan, $data);

            if ($result) {
                // Successfully sent data to the API
                // You can do further processing here if needed
                echo '<script>
                window.history.go(-1); // Go back two steps in the browser history
            </script>';
                return;
            } else {
                // Failed to send data to the API
                // Handle the error appropriately
                echo '<script>alert("data tidak benar"); window.history.go(-1);</script>';
                return;
            }
        } else {
            // Display the form
            return view('admin/data-perusahaan');
        }
    }
    public function output($id_tahapan, $nama_tugas, $id_detail)
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        // if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
        //     // Jika tidak ada session id_pegawai atau jika level bukan admin
        //     echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
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
            return view('admin/hasil', $data);
        }
    }

    public function project_pegawai($id, $nama_project)
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        // URL API untuk data proyek
        $strukturApiUrl = "http://192.168.18.158:5000/struktur/$id";

        // URL API untuk data perusahaan
        $tambahApiUrl = "http://192.168.18.158:5000/pegawai";


        $curl = curl_init();

        // Mengambil data proyek
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $strukturApiUrl,
                CURLOPT_RETURNTRANSFER => true,
            )
        );
        $strukturResponse = curl_exec($curl);
        $strukturErr = curl_error($curl);

        // Mengambil data tambah
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $tambahApiUrl,
                CURLOPT_RETURNTRANSFER => true,
            )
        );
        $tambahResponse = curl_exec($curl);
        $tambahErr = curl_error($curl);

        curl_close($curl);

        if ($strukturErr || $tambahErr) {
            echo "Error: " . ($strukturErr ?: $tambahErr);
        } else {
            $strukturData = json_decode($strukturResponse, true);
            $tambahData = json_decode($tambahResponse, true);

            $data['pegawai'] = $strukturData;
            $data['tambah'] = $tambahData;
            $data['nama_project'] = $nama_project;
            $data['id'] = $id;


            return view('admin/struktur', $data);
        }
    }
    public function addDataStruktur()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        // if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
        //     // Jika tidak ada session id_pegawai atau jika level bukan admin
        //     echo '<script>alert("Anda tidak memiliki izin admin");</script>';
        //     // Redirect atau tampilkan halaman lain sesuai dengan kebijakan Anda
        //     return redirect()->to('/Login'); // Contoh: Kembali ke dashboard jika tidak ada izin admin
        // }
        if ($this->request->getMethod() === 'post') {
            // Get the form data
            $id_project = $this->request->getPost('id_project');
            $id_pegawai = $this->request->getPost('id_pegawai');
            $username = $this->request->getPost('username');
            $nama_struktur = $this->request->getPost('nama_struktur');
            $nama_project = $this->request->getPost('nama_project');
            // Validate the form data here (e.g., check if required fields are not empty)
            // Handle validation errors and return an error response if needed

            // Create an instance of the model
            $model = new Admin_model();

            // Prepare the data for sending to the model
            $data = [
                'id_pegawai' => [$id_pegawai],
                'nama_struktur' => $nama_struktur,

            ];

            // Send the data to the model
            $result = $model->addAnggota($id_project, $data);

            if (isset($result['message']) && $result['message'] === "Data struktur added successfully") {
                // Successfully sent data to the API
                // You can do further processing here if needed
                $email = \Config\Services::email();

                $email->setFrom('bagaskoronovian24@gmail.com', 'Aplikasi Monitoring');
                $email->setTo($username); // Set the recipient's email address
                $email->setSubject('Project baru');
                $email->setMessage("project $nama_project"); // Use double quotes to interpolate $id_project

                if ($email->send()) {
                    echo '<script>alert("Data berhasil");</script>';
                    echo '<script>window.history.go(-1);</script>';
                    return;
                } else {
                    echo '<script>alert("Data berhasil dimasukan tapi email tidak terkirim");</script>';
                    echo '<script>window.history.go(-1);</script>';
                    return;
                }

            } elseif (isset($result['message']) && $result['message'] === "Salah satu pegawai sudah ada dalam proyek") {
                // API returned an error
                echo '<script>alert("pegawai sudah ada dimasukan");</script>';
                echo '<script>window.history.go(-1);</script>';
                return;
            } else {
                return redirect()->to(base_url('/admin/project'))->with('error_message', 'Gagal mengirim data');
            }
        } else {
            // Display the form
            return view('admin/');
        }
    }
    public function updateDataStruktur()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        // Ambil data dari formulir
        $id_project = $_POST['id_project'];
        $old_id_pegawai = $_POST['old_id_pegawai'];
        $id_pegawai = $_POST['id_pegawai'];
        $nama_struktur = $_POST['nama_struktur'];

        // Selanjutnya, Anda dapat memanggil model untuk mengirimkan data ke API
        // Di sini, Anda dapat menggunakan fungsi atau metode yang sesuai dalam model Anda
        // untuk mengirim data ke API dengan URL yang ditentukan.
        $apiUrl = "http://192.168.18.158:5000/edit_struktur/$old_id_pegawai/$id_project";

        // Membuat data yang akan dikirim ke API dalam format JSON
        $data = array(
            'new_id_pegawai' => $id_pegawai,
            'new_nama_struktur' => $nama_struktur
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

        // Handle respons dari API jika diperlukan
        // Misalnya, Anda dapat memeriksa $response untuk melihat apakah permintaan berhasil atau tidak.

        // Redirect ke halaman yang sesuai setelah pembaruan
        // Misalnya, kembali ke halaman edit atau halaman daftar perusahaan.

        // Contoh: kembali ke halaman daftar perusahaan
        echo '<script>alert("data berhasil");</script>';
        echo '<script>window.history.go(-1);</script>';
        return;
    }
    public function hapusStruktur($id_pegawai, $id_project)
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }

        // Tentukan URL API
        $api_url = "http://192.168.18.158:5000/struktur/$id_pegawai/$id_project";

        // Inisialisasi cURL
        $ch = curl_init($api_url);

        // Set opsi cURL untuk mengirim permintaan DELETE
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        // Eksekusi permintaan cURL
        $response = curl_exec($ch);

        // Tutup koneksi cURL
        curl_close($ch);

        // Periksa apakah permintaan berhasil
        if ($response === false) {
            // Penanganan kesalahan jika permintaan gagal
            echo "Gagal menghapus perusahaan.";
        } else {
            // Arahkan pengguna ke halaman admin/Perusahaan jika berhasil
            echo '<script>alert("data berhasil");</script>';
            echo '<script>window.history.go(-1);</script>';
            exit;
        }
    }


    public function vendor()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        $apiUrl = "http://192.168.18.158:5000/vendor";
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
            $data['vendor'] = $responseData;
            return view('admin/vendor', $data); // Make sure the view path is correct
        }
    }
    public function addDataVendor()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        if ($this->request->getMethod() === 'post') {
            // Get the form data
            $nama = $this->request->getPost('nama');
            $jenis = $this->request->getPost('jenis');
            $alamat = $this->request->getPost('alamat');
            $phone = $this->request->getPost('phone');

            // Create an instance of the model
            $model = new Admin_model();

            // Prepare the data for sending to the model
            $data = [
                'nama' => $nama,
                'jenis' => $jenis,
                'alamat' => $alamat,
                'phone' => $phone,
            ];

            // Send the data to the model
            $result = $model->addVendor($data);

            if ($result) {
                // Successfully sent data to the API
                // You can do further processing here if needed
                return redirect()->to(base_url('/admin/vendor'))->with('success_message', 'Data berhasil dikirim');
            } else {
                // Failed to send data to the API
                // Handle the error appropriately
                return redirect()->to(base_url('/admin/vendor'));
            }
        } else {
            // Display the form
            return view('admin/vendor');
        }
    }
    public function updateDataVendor()
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }
        //     if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
        //         // Jika tidak ada session id_pegawai atau jika level bukan admin

        //         echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
        // return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

        //          // Contoh: Kembali ke dashboard jika tidak ada izin admin
        //     }
        // Ambil data dari formulir
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $jenis = $_POST['jenis'];
        $alamat = $_POST['alamat'];
        $phone = $_POST['phone'];

        // Selanjutnya, Anda dapat memanggil model untuk mengirimkan data ke API
        // Di sini, Anda dapat menggunakan fungsi atau metode yang sesuai dalam model Anda
        // untuk mengirim data ke API dengan URL yang ditentukan.
        $apiUrl = "http://192.168.18.158:5000/edit_vendor/$id";

        // Membuat data yang akan dikirim ke API dalam format JSON
        $data = array(
            'nama' => $nama,
            'jenis' => $jenis,
            'alamat' => $alamat,
            'phone' => $phone
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

        // Handle respons dari API jika diperlukan
        // Misalnya, Anda dapat memeriksa $response untuk melihat apakah permintaan berhasil atau tidak.

        // Redirect ke halaman yang sesuai setelah pembaruan
        // Misalnya, kembali ke halaman edit atau halaman daftar perusahaan.

        // Contoh: kembali ke halaman daftar perusahaan
        header("Location: /admin/vendor");
        exit;
    }
    public function hapusVendor($id)
    {
        if (!session()->has('id_pegawai') || (session()->has('level') && session()->get('level') !== 'admin')) {
            // Jika tidak ada session id_pegawai atau jika level bukan admin
            echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/";</script>';
            return; // Contoh: Kembali ke dashboard jika tidak ada izin admin

            // Contoh: Kembali ke dashboard jika tidak ada izin admin
        }

        // Tentukan URL API
        $api_url = 'http://192.168.18.158:5000/hapus_vendor/' . $id;

        // Inisialisasi cURL
        $ch = curl_init($api_url);

        // Set opsi cURL untuk mengirim permintaan DELETE
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        // Eksekusi permintaan cURL
        $response = curl_exec($ch);

        // Tutup koneksi cURL
        curl_close($ch);

        // Periksa apakah permintaan berhasil
        if ($response === false) {
            // Penanganan kesalahan jika permintaan gagal
            echo "Gagal menghapus perusahaan.";
        } else {
            // Arahkan pengguna ke halaman admin/Perusahaan jika berhasil
            header("Location: " . base_url('admin/vendor'));
            exit;
        }
    }
    public function coba()
    {
        return view('admin/coba');
    }





}