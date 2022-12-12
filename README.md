# EXT:devhelper

### installation

```
"repositories": [
...
    {
        "type": "git",
        "name": "twestner/devhelper",
        "url": "https://github.com/twestner/devhelper.git"
    }
...
],
```

```
composer require twestner/devhelper
```

### Command addfield
   
helps to add fields to your model in your own extension.

* adds TCA
* adds SQL-statement
* adds property and getter/setter in model
* adds locallang-entry in default and translation

**vendor/bin/typo3cms devhelper:addfield myextension lowercasemodel dbfieldname fieldtype "label_default|label_de"**

**myextension:** use your extension key

**lowercasemodel:** use the lowercase name of the model, e.g. product

**dbfieldname:** use the name of your field to create as you call it for db-purposes

**fieldtype:** use one of the following fieldtypes:
* checkbox
* date
* input
* integer
* rte
* text

**labels:** add your labels separated by pipe, the order of your languages can be defined in extension-configuration

tested with some extensions, created by the extension builder.


### Command addlabel

adds locallang-entry in default and translation (for fe or be)

**vendor/bin/typo3cms devhelper:addlabel myextension labelkey "label_default|label_de" isFe**

**myextension:** use your extension key

**labelkey:** add the key of the label

**labels:** add your labels separated by pipe, the order of your languages can be defined in extension-configuration

**isFe:** boolean for 
* 1 => adds to locallang.xlf
* 0 / no value => adds to locallang_db.xlf


### Extension configuration
baseExtensionPath = packages/
languageKeys = default,de
