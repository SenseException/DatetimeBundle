# BudgegeriaDatetimeBundle

[![Build Status](https://travis-ci.org/SenseException/DatetimeBundle.svg?branch=master)](https://travis-ci.org/SenseException/DatetimeBundle)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/4fc3057b-8dda-4f30-a581-fda74ea85033/mini.png)](https://insight.sensiolabs.com/projects/4fc3057b-8dda-4f30-a581-fda74ea85033)

Symfony bundle for handling the PHP DateTime functionalities.

Handling DateTime functionality for getting current date and time values can be sometimes a bit tricky in Symfony, especially when it comes to unittests. 
This bundle provides helper, services and configuration for datetime of a project.

### Installation

This Bundle has PHP 5.5 as minimum requirement. Add the following package to your `composer.json`

```json
"require": {
    "budgegeria/datetime-bundle": "0.1"
}
```

and add the bundle to your AppKernel.php

```php
// app/AppKernel.php
//...
class AppKernel extends Kernel
{
    //...
    public function registerBundles()
    {
        $bundles = array(
            ...
            new Budgegeria\Bundle\DatetimeBundle\BudgegeriaDatetimeBundle(),
        );
        //...

        return $bundles;
    }
    //...
}
```

#### Configuration

At the moment, only the timezone can be configured. With this, every datetime service will use this timezone as default.

```yaml
budgegeria_datetime:
    timezone: UTC
```

### Services

If you have or need to create a service, that depends on DateTime, you don't want to create that object directly in your classes, because you want the current time.
Injecting the DateTime object with a setter or over a constructor results in a time difference in case you want exactly the date and time when you access the object.
The DatetimeBundle provides services for that.

#### DateTime

All DateTime services are returning the current time and the timezone from the configuration

##### Lazy Loading

**budgegeria_datetime.datetime** -
This prototype service provides a lazy loading wrapper for DateTime which returns always a new instance on service access.
The actual DateTime object will be lazily created on first access on one of its methods, so you can decide yourself when the current time should be fetched.
Since this is a injectable service, this can make your unit tests easy-peasy.

##### Immutable

**budgegeria_datetime.datetime_immutable** -
The same like budgegeria_datetime.datetime, but using DateTimeImmutable instead of DateTime.

##### Global

**budgegeria_datetime.datetime_global** -
The default service behaviour of Symfony can be used with this service. The time doesn't change from its first object creation through the whole execution of the request.

#### Timezone

**budgegeria_datetime.timezone** -
Returns a DateTimeZone object containing the configured timezone.
