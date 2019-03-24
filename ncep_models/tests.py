from django.test import TestCase, Client
from .views import NUM_IMAGES


class NCEPModelTestCase(TestCase):

    def setUp(self):
        """Initialize test data"""

        self.num_images = NUM_IMAGES
        self.client = Client()

    def test_post_images(self):
        """Test the POST request response for retrieving image URLs"""

        response = self.client.post('/ncep_models/images/', {})
        image_cycle = response.json()['image_cycle']

        self.assertEqual(type(image_cycle), list)
        self.assertEqual(len(image_cycle), self.num_images)
