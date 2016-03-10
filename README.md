# Referrer Blocker
## A Plugin for GetSimple CMS that blocks common referral spam sites.


![Screenshot](/assets/screenshot.png)


### About Referrer Blocker

Referrer Blocker is a plugin that inspects the referrer of a website visitor, and checks it against a 
list of referrers that are known to be spammy and/or malicious, it will return a 404 not found error if 
the client's referrer matches any in the list. 

The list of referrers is initally empty, but you can fetch a good list by clicking the "Fetch List" button 
in the top right of the plugins setting page, this list is fetched from  ```https://raw.githubusercontent.com/piwik/referrer-spam-blacklist/master/spammers.txt```

All credit for the list goes towards their contributors.


## Install the plugin

[Download here](http://get-simple.info/extend/plugin/referrer-blocker/1002/)

```
1. Download the plugin zip file.
2. Unzip it into /plugins
3. Activate it in the "Plugins" tab in your GetSimple CMS admin area.
4. Done
```


### Features

- Add custom referrers 
- Whitelist IP addresses (bypasses referrer check)
- English and Norwegian language


### Note

If you want to disable the Donation button in the plugin, go to your settings page and click "Hide donation button", 
or open donation.txt inside ```referrer_blocker/``` and enter "0" in the file and save it.


### Reporting bugs

Please report bugs in the support thread [here](http://get-simple.info/forums/showthread.php?tid=7863) or 
create a [GitHub Issue](https://github.com/HelgeSverre/referrer-blocker/issues).