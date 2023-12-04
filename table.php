<?php 
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "crud";    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database) or die(mysqli_error($conn));
            
    $query = "SELECT site, link, description, id FROM links";
    $sql = mysqli_query($conn,$query) or die(mysqli_error($conn));
    $rows = mysqli_num_rows($sql);
    if($rows == 0)
    {
        echo "<h3> No Links Available</h3>";
    }
    else
    {    
    echo '
        <table class="table">
        <thead>
            <tr>
            <th scope="col">S No.</th>
            <th scope="col">Site</th>
            <th scope="col">Link</th>
            <th scope="col">Description</th>
            </tr>
        </thead>
        <tbody>';
        for($i=0; $i<$rows ;$i++)
        {
        $result = mysqli_fetch_array($sql);
        $site = addslashes($result["site"]);
        $link = addslashes($result["link"]);
        $desc = addslashes($result["description"]);
        $id = $result["id"];
        $no=$i+1;
        $row = '
                <tr data-id="'.$id.'">
                <th scope="row">'.$no.'</th>
                <td data-col="site">'.$site.'</td>
                <td data-col="link"><a target="_blank" href="'.$link.'">'.$link.'</a></td>
                <td data-col="description">'.$desc.'</td>
                <td>
                <button type="button" class="btn btn-primary btn-sm edit-btn" data-id="'.$id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                    <path d="M2.799.548a.5.5 0 0 0-.799.385L1.204 2H1.5a.5.5 0 0 0 .5-.5V.796a.5.5 0 0 0-.146-.348zM13.396 2.05a.5.5 0 0 1 0 .708l-.398.398-9.2 9.2A1.5 1.5 0 0 1 2 12v-1.5a.5.5 0 0 1 .121-.324l9.2-9.2.398-.398a.5.5 0 0 1 .708 0zM14.5 2a.5.5 0 0 1 .5.5V3a.5.5 0 0 1-.5.5H13a.5.5 0 0 1-.5-.5V2.5a.5.5 0 0 1 .5-.5h1zm-2.8 2.798a.5.5 0 0 1 0 .708L3.91 13H3.5a.5.5 0 0 1-.5-.5v-.41l7.494-7.494a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    Edit
                </button>
                <button class="btn btn-danger delete-btn" data-id="'.$id.'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                    </svg>
                </button>
              </td>
                </tr>
            ';
        echo $row;
        }
        echo '</tbody>
        </table>';
    }
    mysqli_close($conn); 
    ?>