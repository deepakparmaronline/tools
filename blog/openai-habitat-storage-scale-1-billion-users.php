<?php
require __DIR__.'/../includes/bootstrap.php';
$post=post_by_slug('openai-habitat-storage-scale-1-billion-users');
ob_start(); ?>
<p>OpenAI has published an engineering deep dive into Habitat, the online storage platform behind ChatGPT, Codex, the API and internal services. The September 11, 2026 post says Habitat handles more than 70 million requests per second, supports products used by more than 1 billion people each week across almost 40 regions, and serves more than 500 petabytes of data.</p>
<h2>Why Habitat exists</h2>
<p>OpenAI says everyday product actions can require many separate data lookups. A login, settings request or new ChatGPT conversation can touch multiple pieces of information. Habitat was built to give product engineers a common storage layer so they do not need to manage schema lookup, routing, authorization, encryption, serialization and connection pooling independently.</p>
<h2>How the platform changed from its first version</h2>
<p>Habitat started at DevDay 2023 as a small Python client library connected to Azure Cosmos DB. As OpenAI added more products and services, client-side changes became difficult to coordinate. OpenAI describes an example where regionally distributing critical data required changes across many clients, feature flags, shadowing and repeated rollouts.</p>
<p>The company eventually moved Habitat into its own service. That created a central deployment and observability point and gave the team a single place to enforce access-control and privacy mechanisms.</p>
<h2>Why OpenAI kept Python before moving to Rust</h2>
<p>OpenAI says the initial Habitat service stayed in Python even though the language added CPU and memory overhead compared with local library execution. The short-term goal was platform stability and unblocking product teams rather than immediate efficiency.</p>
<p>The engineering post explains that asyncio concurrency did not solve CPU-parallelism limits. CPU-heavy work such as routing, compression, encryption, checksumming and health checking could create scheduling delay and increase tail latency. OpenAI measured the delay directly and scaled out Python worker processes instead of relying on high concurrency inside each process.</p>
<h2>How connection pooling created a failure loop</h2>
<p>One detailed example involves client-side connection pooling. OpenAI found that some overloaded processes received increasingly more requests after bursts. The team linked this behavior to Python's aiohttp TCPConnector using LIFO connection reuse. Slower servers returned connections later, which could cause subsequent traffic to concentrate on the same struggling servers.</p>
<p>The team tested the theory by limiting connection reuse and then changed the reuse behavior to FIFO. OpenAI says this broke the feedback loop and reduced request-utilization variance. Today the company says it mostly relies on Istio and Envoy for connection pooling and server-aware balancing.</p>
<h2>Why Habitat limits the query model</h2>
<p>OpenAI deliberately avoids arbitrary SQL queries in Habitat. The service exposes a simpler NoSQL API so requests stay more predictable. Complex queries can create expensive database work that is difficult to isolate at large scale, so Habitat pushes some of that complexity toward product teams and offline systems.</p>
<p>For more complex analysis, OpenAI says it provides secondary views through Rockset and streams changes using change data capture. That keeps analytical workloads away from the online storage path.</p>
<h2>What changed after the Rust migration</h2>
<p>OpenAI says that in the second quarter of 2026, two engineers, Codex and GPT-5.5 rewrote the service in Rust. The Rust service was handling 95% of production requests at the time of publication. OpenAI reports that it is 6x more CPU efficient and 15x more memory efficient than the Python version, with lower average and tail latency.</p>
<h2>What engineers can learn from the architecture</h2>
<p>The useful lesson is not simply that Rust is faster than Python. OpenAI's story is about sequencing. The team first used a constrained API to make scaling predictable, centralized the storage layer to reduce deployment fan-out, measured tail-latency causes, isolated analytical workloads, and only later completed a language migration when the platform was mature enough to justify it.</p>
<h2>What the numbers do and do not prove</h2>
<p>The reported 70-million-requests-per-second, 500-petabyte and billion-user figures describe Habitat's current scale according to OpenAI. They do not mean every ChatGPT request makes the same number of storage calls or that the architecture is a universal blueprint. The engineering post is an account of OpenAI's own system and tradeoffs.</p>
<?php $articleHtml=ob_get_clean();require __DIR__.'/../includes/blog-template.php';
