# Accounts API

## `GET` `/api/accounts`
> 取得帳戶資訊
  - Authorization: Bearer Token
  - Response
    - id : `int`
      - User 的 id
    - account: `string`
      - User 的帳戶名稱
    - balance: `int`
      - User 帳戶中的餘額
    - example:
    ```
    {
        "success": true,
        "message": "Account records fetched successfully",
        "data": {
            "id": 1,
            "account": "test@imfw.com",
            "balance": 500
        }
    }
    ```

## `POST` `/api/accounts`
> 建立存提款記錄
  - Authorization: Bearer Token
  - Request Parameters
    - Required:
      - amount: `int`
        - 存提款金額
        - 須為正整數
      - type: `string`
        - 僅接受 `deposit` 及 `withdraw`
        - `deposit`: 存款
        - `withdraw`: 提款
    - 最後帳戶餘額不可為負數
    - example:
    ```
    {
        "amount": 500,
        "type": "deposit"
    }
    ```
  - Response
    - id: `int`
      - 交易紀錄流水號
    - user_id: `int`
      - 交易 User id
    - amount: `int`
      - 存提款金額
    - type: `string`
      - `deposit`: 存款
      - `withdraw`: 提款
    - balance: `int`
      - 交易後帳戶餘額
    - amount_change: `int`
      - 本次交易增減金額，以正負號表示
    - example
    ```
    {
        "success": true,
        "message": "Account record created successfully",
        "data": {
            "id": 23,
            "user_id": 1,
            "amount": 500,
            "type": "deposit",
            "balance": 1000,
            "amount_change": 500
            "updated_at": "2022-10-29T19:16:28.000000Z",
            "created_at": "2022-10-29T19:16:28.000000Z",
        }
    }
    ```

## `Get` `/api/accounts/{user_id}`
> 查詢帳戶交易明細
  - Authorization: Bearer Token
  - Route Parameters
    - user_id: `int`
      - User 的 id
  - Response
    - id: `int`
      - 交易紀錄流水號
    - user_id: `int`
      - 交易 User id
    - amount: `int`
      - 存提款金額
    - type: `string`
      - `deposit`: 存款
      - `withdraw`: 提款
    - balance: `int`
      - 交易後帳戶餘額
    - amount_change: `int`
      - 本次交易增減金額，以正負號表示
    - example:
    ```
    {
        "success": true,
        "message": "Account records fetched successfully",
        "data": [
            {
                "id": 22,
                "user_id": 1,
                "amount": 500,
                "type": "deposit",
                "balance": 500,
                "created_at": "2022-10-29T17:38:19.000000Z",
                "updated_at": "2022-10-29T17:38:19.000000Z",
                "amount_change": 500
            },
            {
                "id": 23,
                "user_id": 1,
                "amount": 500,
                "type": "deposit",
                "balance": 1000,
                "created_at": "2022-10-29T19:16:28.000000Z",
                "updated_at": "2022-10-29T19:16:28.000000Z",
                "amount_change": 500
            }
        ]
    }
    ```