<?xml version="1.0" encoding="UTF-8"?>
<configuration>
  <system.webServer>

    <!-- ✅ Only rewrite rule for Yii2 Pretty URLs -->
    <rewrite>
      <rules>
        <rule name="Pretty URLs" stopProcessing="true">
          <match url=".*" />
          <conditions logicalGrouping="MatchAll">
            <add input="{REQUEST_FILENAME}" matchType="IsFile" negate="true" />
            <add input="{REQUEST_FILENAME}" matchType="IsDirectory" negate="true" />
          </conditions>
          <action type="Rewrite" url="index.php" />
        </rule>
      </rules>
    </rewrite>

  </system.webServer>
</configuration>
