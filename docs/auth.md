# Auth Api

## `POST` `/api/login`
  - Request Parameters
    - Required
      - email: `string`
      - password: `string`
  - Response
    - example
    ```
    {
        "success": true,
        "message": "User logged in successfully",
        "data": {
            "user": {
                "id": 1,
                "name": "fang",
                "email": "test@imfw.com",
                "email_verified_at": null,
                "created_at": "2022-10-28T18:29:42.000000Z",
                "updated_at": "2022-10-29T02:04:07.000000Z",
                "account": "test@imfw.com"
            },
            "token": "36|LybhhMDAAsxrcdDplfMb66OWGb9lcS7YOK3lyKHF"
        }
    }
    ```

## `POST` `/api/register`
  - Request Parameters
    - Required
      - name: `string`
      - account: `string`
      - email: `string`
      - password: `string`
      - password_confirmation: `string`
      - example:
      ```
      {
        "name": "Test User",
        "account": "Test Account"
        "email": "test@example.com",
        "password": "password",
        "password_confirmation": "password",
      }
      ```
  - Response
    - example
    ```
    {
        "success": true,
        "message": "User registered successfully",
        "data": {
            "user": {
                "id": 12
                "name": "Test User",
                "account": "Test Account",
                "email": "test@example.com",
                "updated_at": "2022-10-29T19:39:26.000000Z",
                "created_at": "2022-10-29T19:39:26.000000Z",
            },
            "token": "37|xGLi5FLYX6VW3dmtIiysY1OCkzqUxWhJPMmRrMwI"
        }
    }
    ```

## `Get` `/api/logout`
  - Authorization: Bearer Token
  - Response
    - example
    ```
    {
        "success": true,
        "message": "Logged out."
    }
    ```