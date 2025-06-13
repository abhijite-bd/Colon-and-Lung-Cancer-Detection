<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancer Detection Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            line-height: 1.6;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #667eea;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: #667eea;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .title {
            font-size: 28px;
            font-weight: bold;
            color: #667eea;
            margin: 0;
        }

        .subtitle {
            color: #666;
            margin: 5px 0 0 0;
        }

        .section {
            margin: 30px 0;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }

        .section h3 {
            color: #667eea;
            margin-top: 0;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
        }

        .result-box {
            background: #f8f9ff;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .status {
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-block;
            font-weight: bold;
            color: white;
        }

        .status.positive {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .status.negative {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .status.warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .confidence-bar {
            width: 100%;
            height: 20px;
            background: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            margin: 10px 0;
        }

        .confidence-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea, #764ba2);

            width: {
                    {
                    str_replace('%', '', $confidence)
                }
            }

            %;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px 0;
        }

        .info-item {
            padding: 15px;
            background: #f9f9f9;
            border-radius: 8px;
        }

        .info-label {
            font-weight: bold;
            color: #667eea;
        }

        .disclaimer {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 20px;
            border-radius: 8px;
            margin: 30px 0;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            color: #666;
        }

        .analyzed-image {
            max-width: 100%;
            height: auto;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">AI</div>
        <h1 class="title">Cancer Detection Report</h1>
        <p class="subtitle">AI-Powered Medical Analysis</p>
    </div>

    <div class="section">
        <h3>Analyzed Image</h3>
        <img src="{{ asset('storage/' . basename($image_path)) }}" alt="Analyzed Medical Image" class="analyzed-image">
    </div>

    <div class="section">
        <h3>Analysis Results</h3>
        <div class="result-box">
            <div style="margin-bottom: 20px;">
                <div class="info-label">Classification:</div>
                <span class="status {{ strtolower($classification) == 'colon benign tissue' ? 'positive' : 'warning' }}">
                    {{ $classification }}
                </span>
            </div>

            <div style="margin-bottom: 20px;">
                <div class="info-label">Confidence Level:</div>
                <div style="font-size: 24px; font-weight: bold; color: #667eea;">{{ $confidence }}</div>
                <div class="confidence-bar">
                    <div class="confidence-fill"></div>
                </div>
            </div>

            <div>
                <div class="info-label">Interpretation:</div>
                <div>
                    @if (strtolower($classification) == 'colon benign tissue')
                    @if (str_replace('%', '', $confidence) > 90)
                    High confidence indication of normal tissue. No signs of malignancy detected.
                    @elseif (str_replace('%', '', $confidence) > 70)
                    Moderate confidence indication of normal tissue. Further clinical evaluation recommended.
                    @else
                    Low confidence result. Additional imaging or biopsy may be warranted.
                    @endif
                    @else
                    @if (str_replace('%', '', $confidence) > 90)
                    High confidence indication of suspicious findings. Immediate clinical follow-up recommended.
                    @elseif (str_replace('%', '', $confidence) > 70)
                    Moderate confidence indication of suspicious findings. Clinical correlation advised.
                    @else
                    Low confidence suspicious findings. Additional diagnostic workup recommended.
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <h3>Technical Details</h3>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">AI Model:</div>
                <div>Convolutional Neural Network</div>
            </div>
            <div class="info-item">
                <div class="info-label">Training Dataset:</div>
                <div>Medical Image Database</div>
            </div>
            <div class="info-item">
                <div class="info-label">Processing Time:</div>
                <div>
                    < 5 seconds</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Image Quality:</div>
                    <div>Acceptable for Analysis</div>
                </div>
            </div>
        </div>

        <div class="disclaimer">
            <h3 style="color: #d97706; margin-top: 0;">⚠️ Important Medical Disclaimer</h3>
            <p><strong>This AI analysis is intended for medical professional use only and should not be used as a substitute for professional medical diagnosis, treatment, or advice.</strong></p>
            <ul>
                <li>This report is generated by artificial intelligence and requires validation by qualified healthcare professionals</li>
                <li>Clinical correlation with patient history and additional diagnostic tests is essential</li>
                <li>Any medical decisions should be made in consultation with licensed healthcare providers</li>
                <li>This system is designed to assist, not replace, clinical judgment</li>
            </ul>
        </div>

        <div class="footer">
            <p><strong>Cancer Detection AI System</strong></p>
            <p>Advanced Medical Imaging Analysis | Powered by Deep Learning Technology</p>
            <p>Report ID: RPT-{{ strtoupper(uniqid()) }} | Generated: {{ $date }}</p>
        </div>
</body>

</html>