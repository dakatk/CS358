from django.test import TestCase, Client
from .views import CREDENTIALS

class UploadTestCase(TestCase):
    """Test cases for requests related to the upload page"""
    
    def setUp(self):
        """Initialize test data"""

        self.credentials = CREDENTIALS
        self.client = Client()

    def test_post_verify_credentials(self):
        """Test the credentials POST response with correct credentials"""
        
        response = self.client.post('/upload/verify/', {'modal_username': 'student', 'modal_password': 'valpo1991'})
        
        self.assertEquals('success' in response.json(), True)
        self.assertEquals(response.json()['success'], 'Credentials successfully validated')

    def test_post_no_username(self):
        """Test the credentials POST response with no username"""

        response = self.client.post('/upload/verify/', {'modal_password': 'valpo1991'})

        self.assertEquals('error' in response.json(), True)
        self.assertEquals(response.json()['error'], 'Username not supplied')
        
    def test_post_no_password(self):
        """Test the credentials POST response with no password"""

        response = self.client.post('/upload/verify/', {'modal_username': 'student'})

        self.assertEquals('error' in response.json(), True)
        self.assertEquals(response.json()['error'], 'Password not supplied')
        
    def test_post_invalid_credentials(self):
        """Test the credentials POST response with incorrect credentials"""

        response = self.client.post('/upload/verify/', {'modal_username': 'swanson', 'modal_password': 'bacon'})

        self.assertEquals('error' in response.json(), True)
        self.assertEquals(response.json()['error'], 'Invalid credentials')
        
