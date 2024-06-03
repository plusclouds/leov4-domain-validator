# Leo4 Domain Validator
This is a micro service to validate domains that is created by customers to understand if the domain is really owned by customer or not.

This project has its own simple database and the aim of this database is to store secrets to be checked by this service and the domain name itself.

## Endpoint
These endpoints will be used to check if the domain is valid or not;

### Get validation key
```
URL: POST https://api4.plusclouds.com/dvs/domain
params;
- domain

Response;
{
  "key": "........................."
}
```

### Check validation
```
URL: GET https://api4.plusclouds.com/dvs/domain
params;
- domain: Domain name of the website like; niyel.com.tr

Reponse;
- is_valid: true|false
```
