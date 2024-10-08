[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/signify-nz/silverstripe-environmentindicator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/signify-nz/silverstripe-environmentindicator/?branch=master)

# Environment Indicator

The Environment Indicator Vendor Module reads the SS_ENVIRONMENT_TYPE variable in your .env file (dev, test or live) and loads the applicable javascript to insert a custom div above the menu header in the CMS Admin interface.

The EnvBarExtension also inserts a custom element into the HTML of all pages to provide an information bar detailing the environment and page version. If the logged-in user has access to pages in the CMS, the bar acts as a link to open the page in the CMS via a new browser tab.

The bar does not appear in live mode for unauthorised users.

## Requirements

-   [SilverStripe CMS ^4](https://github.com/silverstripe/silverstripe-cms) OR [SilverStripe CMS ^5](https://github.com/silverstripe/silverstripe-cms)

## Installation

**Composer:**

```
    composer require signify-nz/silverstripe-environmentindicator
```

## Documentation

No further configuration is required.

Customisation can be achieved by editing the EnvBar.ss template or the envbar- .js and .css files. Functional tests are available in the tests directory. These will need to be updated if you modify the template.

-   [Changelog](CHANGELOG.md)
-   [Contributing](CONTRIBUTING.md)
-   [Issues](https://github.com/signify-nz/silverstripe-environmentindicator/issues)
-   [License](LICENSE.md)

## Usage

This module performs an informative function only. No special usage instructions are available.

![Live Published Anonymous](docs/en/img/Live_Pub_Anon.png)
![Live Published Editor](docs/en/img/Live_Pub_Edit.png)
![Live Draft Editor](docs/en/img/Live_Draft_Edit.png)
![Live CMS Page](docs/en/img/Live_CMS_Page.png)
![Live CMS Tree](docs/en/img/Live_CMS_Tree.png)

![Test Published Anonymous](docs/en/img/Test_Pub_Anon.png)
![Test Published Editor](docs/en/img/Test_Pub_Edit.png)
![Test Draft Editor](docs/en/img/Test_Draft_Edit.png)
![Test CMS Page](docs/en/img/Test_CMS_Page.png)
![Test CMS Tree](docs/en/img/Test_CMS_Tree.png)

![Dev Published Anonymous](docs/en/img/Dev_Pub_Anon.png)
![Dev Published Editor](docs/en/img/Dev_Pub_Edit.png)
![Dev Draft Editor](docs/en/img/Dev_Draft_Edit.png)
![Dev CMS Page](docs/en/img/Dev_CMS_Page.png)
![Dev CMS Tree](docs/en/img/Dev_CMS_Tree.png)
