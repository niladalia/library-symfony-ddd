  Feature: Post book
  In order to create books
  As a user
  I want to create a new book

  Scenario: Create an book
    Given I send a POST request to "/api/book" with body:
    """
    {
      "title": "The worst Book",
      "description": "Amazing book from UK",
      "score": 5
    }
    """
    Then the response status code should be 201
    And the response should contain a "book_id" with valid UUID
