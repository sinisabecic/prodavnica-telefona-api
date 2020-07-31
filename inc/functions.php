<?php
    function productPoloName()
    {
        $getPolo = $pd->latestFromPolo();
        if ($getPolo) {
            while ($result = $getPolo->fetch_assoc()) {
                echo $result['productName'];
            }
        }
    }


    function productPoloId()
    {
        $getPolo = $pd->latestFromPolo();
        if ($getPolo) {
            while ($result = $getPolo->fetch_assoc()) {
                echo $result['productId'];
            }
        }
    }


    function categoryPoloName()
    {
        $getCat = $cat->getAllCat();
        if ($getCat) {
            while ($row = $getCat->fetch_assoc()) {
                echo $row['catName'];
            }
        }
    }
