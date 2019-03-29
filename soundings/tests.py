from django.test import TestCase, Client
from .vies import get_launch_sub_dirs

class SoundingsTestCase(TestCase):
    """Test cases for requests related to the KVUM soundings page

    def setUp(self):
        """Initialize test data

        self.num_images = len(get_launch_sub_dirs())
        self.client = Client()

    def test_post_images(self):
        """Test the POST request response for images"""
        
        response = self.client.post('/soundings/images/', {})
        image_selects = response.json()['image_selects']

        self.assertEqual(type(image_selects), list)
        self.assertEqual(type(len(image_selects), self.num_images)

    # TODO add tests for parsing SUMMARY and STD files
