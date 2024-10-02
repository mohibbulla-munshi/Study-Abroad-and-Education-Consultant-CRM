<template>
  <v-container fluid>
    <!-- Header -->
    <header>
      <v-toolbar app>
        <v-toolbar-title>Your Logo</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn text>Home</v-btn>
        <v-btn text>About Us</v-btn>
        <v-btn text>Services</v-btn>
        <v-btn text>Contact</v-btn>
        <v-btn text>Login/Signup</v-btn>
      </v-toolbar>
    </header>

    <!-- Hero Section -->
    <v-row>
      <v-col class="text-center" style="background-image: url('path/to/your/image.jpg'); height: 400px;">
        <h1>Your Gateway to Global Education</h1>
        <v-btn color="primary" @click="navigateToServices">Get Started</v-btn>
      </v-col>
    </v-row>

    <!-- Features Section -->
    <v-row>
      <v-col v-for="feature in features" :key="feature.title" cols="12" sm="4">
        <v-card>
          <v-card-title>{{ feature.title }}</v-card-title>
          <v-card-text>{{ feature.description }}</v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <!-- Testimonials Section -->
    <v-row>
      <v-col v-for="testimonial in testimonials" :key="testimonial.name" cols="12" sm="6">
        <v-card>
          <v-card-title>{{ testimonial.name }}</v-card-title>
          <v-card-text>{{ testimonial.feedback }}</v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <!-- Blog Section -->
    <v-row>
      <v-col v-for="post in recentPosts" :key="post.title" cols="12" sm="4">
        <v-card>
          <v-card-title>{{ post.title }}</v-card-title>
          <v-card-text>{{ post.excerpt }}</v-card-text>
          <v-btn @click="readMore(post)">Read More</v-btn>
        </v-card>
      </v-col>
    </v-row>

    <!-- Footer -->
    <footer>
      <v-container>
        <v-row>
          <v-col>
            <p>Contact Us: (123) 456-7890</p>
            <p>Email: info@yourconsultancy.com</p>
          </v-col>
          <v-col>
            <v-icon>mdi-facebook</v-icon>
            <v-icon>mdi-twitter</v-icon>
            <v-icon>mdi-instagram</v-icon>
          </v-col>
        </v-row>
      </v-container>
    </footer>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      features: [
        { title: 'University Selection', description: 'Get guidance on choosing the right university.' },
        { title: 'Visa Assistance', description: 'We help you with the visa application process.' },
        { title: 'Scholarship Guidance', description: 'Find scholarships that fit your profile.' },
      ],
      testimonials: [
        { name: 'John Doe', feedback: 'The consultancy helped me so much!' },
        { name: 'Jane Smith', feedback: 'I got into my dream university.' },
      ],
      recentPosts: [
        { title: 'Tips for Studying Abroad', excerpt: 'Learn the best practices for your journey.' },
        { title: 'How to Apply for a Visa', excerpt: 'A step-by-step guide.' },
      ],
    };
  },
  methods: {
    navigateToServices() {
      this.$router.push('/services'); // Assuming you have Vue Router set up
    },
    readMore(post) {
      this.$router.push(`/blog/${post.id}`); // Route to the full blog post
    },
  },
};
</script>

<style>
.header {
  background-color: #f8f9fa;
}
.hero {
  color: white;
  text-align: center;
  padding: 50px 0;
}
</style>
