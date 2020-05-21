<?php

function formatMoney(int $price) {
    $decimal = $price/100;
    return 'R$ ' . number_format($decimal, 2, ',', '');
}