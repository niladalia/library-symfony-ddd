Feature: Get all books
    In order to have books
    As a user
    I want to see the all books

    Scenario: Retrieve all books
        Given there is a book with ID "07600ba1-ca95-4709-b36c-76538ce9e7f7" and title "Amazing Book"
        And I send a GET request to "/api/book/07600ba1-ca95-4709-b36c-76538ce9e7f7"
        Then the response status code should be 200
        And the response content should be:
        """
        {
            "id": "07600ba1-ca95-4709-b36c-76538ce9e7f7",
            "title": "Amazing Book",
            "image": "",
            "score": null,
            "description": null,
            "author": null
        }
        """
