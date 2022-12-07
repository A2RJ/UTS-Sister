@extends('layouts.blank')

<div>
    <p>Hallo {{ $id }}</p>
</div>


@section('plugin_js')
    <script>
        function downloadFile() {
            const url = `http://sister.uts.ac.id/ws.php/1.0/dokumen/{{ $id }}/download`
            const headers = new Headers()
            headers.append('Authorization', "Bearer {{ session('token') }}")
            fetch(url, {
                method: 'GET',
                withCredentials: true,
                crossorigin: true,
                mode: 'no-cors',
                headers: headers

            }).then(function(response) {
                // The API call was successful!
                return response.json();
            }).then(function(data) {
                // This is the JSON from our response
                console.log(data);
            }).catch(function(err) {
                // There was an error
                console.warn('Something went wrong.', err);
            });
            // axios.get(url, {
            //         // responseType: 'arraybuffer',
            //         headers: {
            //             'Access-Control-Allow-Origin': "http://localhost:8000",
            //             'Access-Control-Allow-Credentials': 'true',
            //             // 'Accept': 'application/pdf',
            //             'Authorization': "Bearer {{ session('token') }}"
            //         }
            //     })
            // var headers = {}

            // fetch(url, {
            //         method: "GET",
            //         mode: 'cors',
            //         headers: headers
            //     })
            //     .then((response) => {
            //         if (!response.ok) {
            //             throw new Error(response.error)
            //         }
            //         return response.json();
            //     })
            //     .then((response) => {
            //         const url = window.URL.createObjectURL(new Blob([response.data]));
            //         const link = document.createElement('a');
            //         link.href = url;
            //         link.setAttribute('download', 'file.pdf'); //or any other extension
            //         document.body.appendChild(link);
            //         link.click();
            //     })
            //     .catch((error) => console.log(error));
        }
        downloadFile()
    </script>
@endsection
