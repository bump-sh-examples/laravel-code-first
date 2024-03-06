# Laravel Code First

A quick "Hello World" Laravel application, but for generating OpenAPI, using the Laravel extension [Swagger-PHP](https://zircote.github.io/swagger-php/).

This repository was built as sample code for the Bump.sh guide on [Generating OpenAPI docs for Laravel with Swagger-PHP](https://docs.bump.sh/guides/openapi/code-first-laravel/).

## Usage

Clone the repository down to give it a try.

```
# Set everything up
$ composer install

# Export the OpenAPI
$ ./vendor/bin/openapi app -o openapi.yaml

# Take a look at the generated OpenAPI
cat openapi.yaml
```

Preview how the API reference docs look [on Bump.sh](https://bump.sh/bump-examples/hub/code-samples/doc/laravel-code-first).

## License

The contents of this repository are licensed under [CC BY-SA
  4.0](./LICENSE_CC-BY-SA-4.0).
