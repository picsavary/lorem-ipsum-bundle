# lorem-ipsum-bundle

author: anne marie savary <picsavary@icloud.com>

This project and its code is under MIT License

Required: Symfony ^5.0 - Php ^7.4


# LoremIpsumBundle for Symfony ^5.0
LoremIpsumBundle is a way for you to generate english "fake text" into
your Symfony ^5.0 application.
Install the package with:
```console
composer require amps/lorem-ipsum-bundle dev-master
```
And... that's it! If you're *not* using Symfony Flex, you'll also
need to enable the `Amps\LoremIpsumBundle\AmpsLoremIpsumBundle`
in your `AppKernel.php` file.
## Usage
This bundle provides a single service for generating fake text, which
you can autowire by using the `KnpUIpsum` type-hint:
```php
// src/Controller/SomeController.php
use Amps\LoremIpsumBundle\KnpUIpsum;
// ...
class SomeController
{
    public function index(KnpUIpsum $knpUIpsum)
    {
        $fakeText = $knpUIpsum->getParagraphs();
        // ...
    }
}
```
You can also access this service directly using the id
`amps_lorem_ipsum.knpu_ipsum`.
## Configuration
A few parts of the generated text can be configured directly by
creating a new `config/packages/amps_lorem_ipsum.yaml` file. The
default values are:
```yaml
# config/packages/amps_lorem_ipsum.yaml
amps_lorem_ipsum:
    # Whether or not you believe in unicorns
    unicorns_are_real:    true
    # How much do you like sunshine?
    min_sunshine:         3
```
## Extending the Word List
You can add your *own* words to the word generator!
To do that, create a class that implements `WordProviderInterface`:
```php
namespace App\Service;
use Amps\LoremIpsumBundle\WordProviderInterface;
class CustomWordProvider implements WordProviderInterface
{
    // 
    public function getWordList(): array
    {
       $words[] = 'beach';
       $words[] = $title;
       $words[] = $town;
       return $words;
    }
}
```
And... that's it! If you're using the standard service configuration,
your new class will automatically be registered as a service and used
by the system. If you are not, you will need to register this class
as a service and tag it with `amps_ipsum_word_provider`.
## Thanks
Thanks to knpu_lorem_ipsum_bundle.

## Contributing
Of course, open source is fueled by everyone's ability to give just a little bit
of their time for the greater good. If you'd like to see a feature or add some of
your *own* happy words, awesome! Tou can request it - but creating a pull request
is an even better way to get things done.
Either way, please feel comfortable submitting issues or pull requests: all contributions
and questions are warmly appreciated :).
