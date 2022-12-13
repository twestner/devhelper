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
composer require twestner/devhelper:dev-master --dev
```

### Command addfield
   
helps to add fields to your model in your own extension.

* adds TCA
* adds SQL-statement
* adds property and getter/setter in model
* adds locallang-entry in default and translation

**vendor/bin/typo3cms devhelper:addfield myextension lowercasemodel dbfieldname fieldtype "label_default|label_de"**

e.g.

vendor/bin/typo3cms devhelper:addfield myextension mymodel new_field checkbox "label of new field|Name meines neuen Feldes"

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
* file (one file)
* files (more files)
* image (one image)
* images (more images)

**labels:** add your labels separated by pipe, the order of your languages can be defined in extension-configuration

tested with some extensions, mainly created by the extension builder.


### Command addlabel

adds locallang-entry in default and translation (for fe or be)

**vendor/bin/typo3cms devhelper:addlabel myextension labelkey "label_default|label_de" isFe**

vendor/bin/typo3cms devhelper:addlabel myextension "name of my palette, Name meiner Palette im BE" 0
vendor/bin/typo3cms devhelper:addlabel myextension "Search now, Jetzt suchen" 1

**myextension:** use your extension key

**labelkey:** add the key of the label

**labels:** add your labels separated by pipe, the order of your languages can be defined in extension-configuration

**isFe:** boolean for 
* 1 => adds to locallang.xlf
* 0 / no value => adds to locallang_db.xlf

tested with some extensions, mainly created by the extension builder.

### Extension configuration
baseExtensionPath = packages/

languageKeys = default,de
