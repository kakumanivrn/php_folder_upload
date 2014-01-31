<script>
    window.onload = function() {
        document.getElementById('files').onchange = function(e) {
            savePaths(e.target.files);
            uploadFiles(e.target.files);
        };
    };

    function savePaths(files) {
        xhr = new XMLHttpRequest();
        data = new FormData();
        var paths = "";
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
               alert(xhr.responseText);
            }
        };
        for (var i in files) {
            paths += files[i].webkitRelativePath + "###";
        }
        data.append("paths", paths);
        xhr.open("POST", "savePaths.php", true);
        xhr.send(this.data);
    }

    function uploadFiles(files) {
        xhr = new XMLHttpRequest();
        data = new FormData();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                alert(xhr.responseText);
            }
        };
        for (var i in files) {
            if (typeof files[i].webkitRelativePath != "undefined") {
                var lastChar = files[i].webkitRelativePath.substr(files[i].webkitRelativePath.length - 1);
                if (lastChar !== '.') {
                    data.append(i, files[i]);
                }
            }
        }
        xhr.open('POST', "upload.php", true);
        xhr.send(data);
    }
</script>

<input type="file" id="files" name="files[]" webkitdirectory directory multiple/>
<input type="hidden" name="paths" id="paths"/>

