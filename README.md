# Leo4 Domain Validator
This is a micro service to validate domains that is created by customers to understand if the domain is really owned by customer or not.

This project has its own simple database and the aim of this database is to store secrets to be checked by this service and the domain name itself.

## Endpoint
These endpoints will be used to check if the domain is valid or not;

### Get validation methods
```
URL: GET https://api4.plusclouds.com/dvs/validation-methods

Response;
[
  {
    "name": "Validation with HTTP",
    "description":"....",
    "value":"http"
  }
]
```

### Add domain to database
```
URL: POST https://api4.plusclouds.com/dvs/domain
header;
- Authorization: {token}
params;
- domain_id
- validation_method

Reponse;
- validation_token: UUID token
```

### Validate domain
```
URL: GET https://apiv4.plusclouds.com/dvs/domain/:domain_id
- Authorization: {token}

Response:
[
  {
    "is_valid": "true"
  }
]

OR

[
  {
    "is_valid": "false",
    "reason":"...."
  }
]
```
