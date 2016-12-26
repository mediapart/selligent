# Testing the library


## Default tests

```bash
./vendor/bin/phpunit --configuration phpunit.xml.dist --testsuite default
```


## Integrated tests

With the `real` testsuite, you could execute a serie of tests who will be applied to a given host. 
Some environment variables are required to execute integrated tests :

- soap_login
- soap_password
- soap_wsdl_individual
- soap_wsdl_broadcast
- selligent_list
- selligent_gate
- selligent_folderid 
- selligent_maildomainid 
- selligent_listid 
- selligent_segmentid 
- selligent_queueid 
- selligent_macategory 
