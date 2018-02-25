# Pipes.  

This is my little contribution Water Supplier World Wide, i'm kidding. This can help you to perform action chaning. Checkout this silly example:  

```  
use gravataloga\Pipe;

$ltd = $pipe->given('https://jonathan.pt/rascunhos')
->pipe(function ($item) {
    return parse_url($item, PHP_URL_HOST);
})
->pipe(function ($item) {
    $last = (new Pipe($item))->pipe(function ($sub) {
        return explode('.', $sub);
    })->pipe(function ($sub) {
        return end($sub);
    })->end();
    return $last;
})->end();

echo $ltd; // pt
```  

