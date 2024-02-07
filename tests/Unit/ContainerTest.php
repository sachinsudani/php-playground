<?php
use Core\Container;

test('it can resolve something from the container', function () {
    $container = new Container();

    $container->bind('foo', function () {
        return 'bar';
    });

    $result = $container->resolve('foo');

    expect($result)->toBe('bar');
});