package main

import (
	"encoding/json"
	"fmt"
	"io"
	"net/http"
	"net/url"
	"os"
	"strings"
	"time"
)

const endpoint = "https://panel.neofollower.com/api/v1"

var client = &http.Client{Timeout: 30 * time.Second}

func requestAPI(apiKey string, values url.Values) (any, error) {
	values.Set("key", apiKey)

	req, err := http.NewRequest(
		http.MethodPost,
		endpoint,
		strings.NewReader(values.Encode()),
	)
	if err != nil {
		return nil, err
	}

	req.Header.Set("Content-Type", "application/x-www-form-urlencoded")
	req.Header.Set("Accept", "application/json")

	resp, err := client.Do(req)
	if err != nil {
		return nil, err
	}
	defer resp.Body.Close()

	body, err := io.ReadAll(resp.Body)
	if err != nil {
		return nil, err
	}

	if resp.StatusCode < 200 || resp.StatusCode >= 300 {
		return nil, fmt.Errorf("NeoFollower API HTTP error %d: %s", resp.StatusCode, body)
	}

	var result any
	if err := json.Unmarshal(body, &result); err != nil {
		return nil, err
	}

	return result, nil
}

func main() {
	apiKey := os.Getenv("NEOFOLLOWER_API_KEY")
	if apiKey == "" {
		panic("set NEOFOLLOWER_API_KEY first")
	}

	result, err := requestAPI(apiKey, url.Values{
		"action": {"balance"},
	})
	if err != nil {
		panic(err)
	}

	pretty, _ := json.MarshalIndent(result, "", "  ")
	fmt.Println(string(pretty))
}
