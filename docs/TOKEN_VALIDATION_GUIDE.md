## Token Creation

validationToken structure:
- domain
- createdAt

- Encryption library of laravel will be used to encrypt/decrypt the tokens. ([https://laravel.com/docs/11.x/encryption](https://laravel.com/docs/11.x/encryption))

## Token Validation
When the domain is passed to the service both validation methods are checked:
1. DNS(CNAME)
- **dns_get_record** function will be used to retrieve only **TXT** records from the domain, which will then be passed to the **ValidateToken** function.
- Based on the return from **ValidateToken** function, the user will get the corresponding response
2. HTTP
- **file_get_contents** function will be used to retrieve the corresponding **validate.txt** file content from the provided domain + requested file path (domain + "/.well-known/validate.txt").
- Then, the contents will be passed to the **ValidateToken** function.
- Based on the return from the **ValidateToken** function, the user will get the corresponding response

### ValidateToken(domain, token): bool
- The retrieved token will be decrypted to access to the payload.
- If the payload is invalid/token missing, return false
- If the token/payload is valid:
    - createdAt date will be checked if the token is expired using the expiration timespan variable in the .env file
        - If the token is expired, return false
    - The domain name passed from the request, and the domain name extracted from the payload will be checked
        - If both does not match, return false
    - If all conditions apply, the function will return true
