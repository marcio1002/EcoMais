<?php
    use Model\AccountHandling;
    use Model\PersonPhysical;
    use Exception;

    try {

        $account = new AccountHandling();
        $register = new PersonPhysical();

        $register->setName($_POST['name']);
        $register->setEmail($_POST['email']);
        $register->setPassword($_POST['pwd']);

        if ($account->createAccount($register)) {
            echo json_encode(["error" => false, "status" => 200, "msg" => "Ok"],);
        } else {
            throw new Exception("Ocorreu um erro ao criar conta");
        }
    } catch (Exception $ex) {
        echo json_encode(["error" => true, "status" => $ex->getCode(), "msg" => $ex->getMessage()]);
    }
