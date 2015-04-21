// app/lib/Acme/Product/Anvil/AnvilHeavy.php
<?php namespace Acme\Product\Anvil;

class AnvilHeavy implements AnvilInterface {

    public function drop()
    {
        return "ouch!";
    }

}
