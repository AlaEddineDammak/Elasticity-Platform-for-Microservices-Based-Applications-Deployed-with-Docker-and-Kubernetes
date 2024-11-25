# Elasticity Platform for Microservices-Based Applications

## Project Description
This project aims to develop an **elasticity platform** for applications based on a microservices architecture. These applications are deployed using **Docker containers** and orchestrated by **Kubernetes**. The platform enables dynamic resource adjustment through two main phases:

1. **Resource Monitoring**: Collect metrics such as CPU and memory usage for each microservice using tools like **Prometheus**.
2. **Resource Management**: Add or remove containers based on detected overutilization or underutilization of resources.

Additionally, an **interactive graphical interface** will allow users to visualize the microservices, their monitoring status, and container management.

## Features
1. **Real-Time Monitoring**:
   - Collect CPU and memory metrics for each microservice.
   - Display metrics via a graphical interface using **Grafana**.
2. **Elastic Resource Management**:
   - Automatically scale up by adding containers for overutilized microservices.
   - Automatically scale down by removing containers for underutilized microservices.
3. **User-Friendly Interface**:
   - Visualize the state of each microservice and container.
   - Monitor applications and manage elasticity decisions in real-time.

## Tools and Technologies
- **Programming Language**: Python
- **Containerization**: Docker
- **Orchestration**: Kubernetes
- **Monitoring and Visualization**: Prometheus and Grafana

## Installation and Setup
### Prerequisites
- Install Docker and Kubernetes on your system.
- Install Prometheus and Grafana for monitoring and visualization.
- Ensure Python (version 3.8 or higher) is installed.
