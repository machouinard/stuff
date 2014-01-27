<div class="grid_10 push_3">
    <?php
$factorial = function( $n ) use ( &$factorial ) {
    if( $n == 1 ) return 1;
    return $factorial( $n - 1 ) * $n;
};
print $factorial( 5 );


echo 'Factorial: '.factorial(4);

function factorial($x){
    if($x == 1){
        return $x;
    }else{
        return factorial($x-1) * $x;
    }
}
    ?>
</div>

3
2*3