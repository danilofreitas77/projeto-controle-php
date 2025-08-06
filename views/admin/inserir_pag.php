<?php

    require '../templates/header.php';

?>

<style>
    
    main{
        display: flex;
        justify-content: center;
    }

    form{
        
        border-radius: 10px;
        width: 40%;
        height: 90%;
        justify-content: center;
        align-items: center;
        align-items: center;
    }

    form input{
        width: 40%;
    }

   

</style>

<main>
    <form action="" method="post">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Fornecedor</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Digite o nome do fornecedor">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Valor</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Digite o valor">
        </div>

        <div class="row">

            <div class="col">
                <select class="form-select" aria-label="Default select example">
                    <option selected>Setor</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>

            <div class="col">
                <select class="form-select" aria-label="Default select example">
                    <option selected>Subsetor</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>

        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Data</label>
            <input type="date" class="form-control" id="exampleFormControlInput1">
        </div>

        <div class="input-group mb-3">
            <input type="file" class="form-control" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
        </div>

        <input class="btn btn-primary" type="submit" value="Submit">

        

        
        
    </form>
</main>


<?php

    require '../templates/footer.php';

?>