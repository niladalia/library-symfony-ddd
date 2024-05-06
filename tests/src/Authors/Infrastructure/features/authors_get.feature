Feature: Get all authors
    In order to have authors
    As a user
    I want to see the all authors

    Scenario: Retrieve all authors
        When I send a GET request to "/api/author"
        Then the response should be received
        Then the response status code should be 200