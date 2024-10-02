# Use official Node.js image as the base image
FROM node:18-alpine

# Set working directory in the container
WORKDIR /app

# Copy package.json and package-lock.json to install dependencies
COPY package*.json ./

# Install dependencies
RUN npm install

# Set environment variable to bypass OpenSSL error
ENV NODE_OPTIONS=--openssl-legacy-provider

# Copy the rest of the app to the working directory
COPY . .

# Expose the port on which the app will run
EXPOSE 8080

# Run the development server
CMD ["npm", "run", "serve"]
