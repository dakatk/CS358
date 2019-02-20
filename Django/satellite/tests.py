from django.test import TestCase, Client
from .views import NUM_IMAGES


class SatelliteTestCases(TestCase):
    def setUp(self):
        self.num_images = NUM_IMAGES
        self.client = Client()

    def test_post_true_color(self):
        response = self.client.post('/satellite/image_desc/', {'channel': 'true_color'})
        image_cycle = response.json()['image_cycle']

        self.assertEqual(type(image_cycle), list)
        self.assertEqual(len(image_cycle), self.num_images)

    def test_post_1_blue(self):
        response = self.client.post('/satellite/image_desc/', {'channel': '1_blue'})
        image_cycle = response.json()['image_cycle']

        self.assertEqual(type(image_cycle), list)
        self.assertEqual(len(image_cycle), self.num_images)

    def test_post_2_red(self):
        response = self.client.post('/satellite/image_desc/', {'channel': '2_red'})
        image_cycle = response.json()['image_cycle']

        self.assertEqual(type(image_cycle), list)
        self.assertEqual(len(image_cycle), self.num_images)

    def test_post_4_nir(self):
        response = self.client.post('/satellite/image_desc/', {'channel': '4_nir'})
        image_cycle = response.json()['image_cycle']

        self.assertEqual(type(image_cycle), list)
        self.assertEqual(len(image_cycle), self.num_images)

    def test_post_9_wv(self):
        response = self.client.post('/satellite/image_desc/', {'channel': '9_wv'})
        image_cycle = response.json()['image_cycle']

        self.assertEqual(type(image_cycle), list)
        self.assertEqual(len(image_cycle), self.num_images)

    def test_post_14_longwave(self):
        response = self.client.post('/satellite/image_desc/', {'channel': '14_longwave'})
        image_cycle = response.json()['image_cycle']

        self.assertEqual(type(image_cycle), list)
        self.assertEqual(len(image_cycle), self.num_images)
